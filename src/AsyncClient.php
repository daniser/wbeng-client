<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Exception;
use Http\Client\HttpAsyncClient;
use Http\Discovery\HttpAsyncClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Promise\Promise;
use JMS\Serializer\SerializerInterface as JMSSerializerInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\CreateBooking;
use TTBooking\WBEngine\DTO\FlightFares;
use TTBooking\WBEngine\DTO\SearchFlights;
use TTBooking\WBEngine\DTO\SelectFlight;
use TTBooking\WBEngine\Enums\Query;

class AsyncClient implements AsyncClientInterface
{
    protected HttpAsyncClient $httpClient;

    protected RequestFactoryInterface $requestFactory;

    protected StreamFactoryInterface $streamFactory;

    protected ValidatorInterface $validator;

    protected JMSSerializerInterface|SymfonySerializerInterface $serializer;

    public function __construct(
        protected string $baseUri,
        protected Common\Request\Context $context,
        protected bool $legacy = true,
        HttpAsyncClient $httpClient = null,
        RequestFactoryInterface $requestFactory = null,
        StreamFactoryInterface $streamFactory = null,
        ValidatorInterface $validator = null,
        JMSSerializerInterface|SymfonySerializerInterface $serializer = null,
    ) {
        $this->baseUri = rtrim($baseUri, '/');
        $this->httpClient = $httpClient ?? HttpAsyncClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
        $this->validator = $validator ?? Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        $this->serializer = $serializer ?? SerializerFactory::discoverSerializer($legacy);
        $this->validate($context);
    }

    public function searchFlights(SearchFlights\Request\Parameters $parameters): Promise
    {
        /** @var Promise<Common\Response> */
        return $this->query(Query::Flights, $parameters);
    }

    public function selectFlight(SelectFlight\Request\Parameters $parameters, string $provider = null, string $gds = null): Promise
    {
        /** @var Promise<Common\Response> */
        return $this->query(Query::Price, $parameters, $provider, $gds);
    }

    public function createBooking(CreateBooking\Request\Parameters $parameters, string $provider = null, string $gds = null): Promise
    {
        /** @var Promise<CreateBooking\Response> */
        return $this->query(Query::Book, $parameters, $provider, $gds);
    }

    public function flightFares(Common\Request\Parameters $parameters, string $provider = null, string $gds = null): Promise
    {
        /** @var Promise<FlightFares\Response> */
        return $this->query(Query::FlightFares, $parameters, $provider, $gds);
    }

    /**
     * @return Promise<object>
     */
    protected function query(Query $query, object $parameters, mixed ...$args): Promise
    {
        $this->validate($parameters);

        $request = $query->newRequest($this->context, $parameters, ...$args);

        $body = $this->serializer->serialize($request, 'json');

        return $this->request($query->value, method: 'POST', body: $body)
            ->then(function (ResponseInterface $response) use ($query) {
                $result = (string) $response->getBody();

                /** @var object */
                return $this->serializer->deserialize($result, $query->response(), 'json');
            });
    }

    protected function validate(object $entity): void
    {
        $violations = $this->validator->validate($entity);

        if (count($violations)) {
            throw new ValidationFailedException($entity, $violations);
        }
    }

    /**
     * @param array<string, string>        $headers
     * @param array<string, string>|string $body
     *
     * @return Promise<ResponseInterface>
     *
     * @throws Exception
     */
    protected function request(string $endpoint, array $headers = [], string $method = 'GET', array|string $body = ''): Promise
    {
        $this->legacy && $endpoint .= '?legacy=on';
        $request = $this->requestFactory->createRequest($method, "$this->baseUri/$endpoint");

        $headers = array_merge($headers, [
            'Content-Type' => 'application/json',
        ]);

        foreach ($headers as $header => $value) {
            $request = $request->withHeader($header, $value);
        }

        if ($body) {
            $stream = $this->streamFactory->createStream(is_array($body) ? http_build_query($body) : $body);
            $request = $request->withBody($stream);
        }

        return $this->httpClient->sendAsyncRequest($request);
    }
}
