<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\CreateBooking;
use TTBooking\WBEngine\DTO\FlightFares;
use TTBooking\WBEngine\DTO\SearchFlights;
use TTBooking\WBEngine\DTO\SelectFlight;
use TTBooking\WBEngine\Enums\Query;

class Client implements ClientInterface
{
    protected HttpClientInterface $httpClient;

    protected RequestFactoryInterface $requestFactory;

    protected StreamFactoryInterface $streamFactory;

    protected ValidatorInterface $validator;

    protected SerializerInterface $serializer;

    public function __construct(
        protected string $baseUri,
        protected Common\Request\Context $context,
        HttpClientInterface $httpClient = null,
        RequestFactoryInterface $requestFactory = null,
        StreamFactoryInterface $streamFactory = null,
        ValidatorInterface $validator = null,
        SerializerInterface $serializer = null,
    ) {
        $this->baseUri = rtrim($baseUri, '/');
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
        $this->validator = $validator ?? Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        $this->serializer = $serializer ?? SerializerBuilder::create()
            ->enableEnumSupport()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy)
            ->build();
    }

    public function searchFlights(SearchFlights\Request\Parameters $parameters): SearchFlights\Response
    {
        /** @var SearchFlights\Response */
        return $this->query(Query::Flights, $parameters);
    }

    public function selectFlight(Common\Request\Parameters $parameters): SelectFlight\Response
    {
        /** @var SelectFlight\Response */
        return $this->query(Query::Price, $parameters);
    }

    public function createBooking(CreateBooking\Request\Parameters $parameters): CreateBooking\Response
    {
        /** @var CreateBooking\Response */
        return $this->query(Query::Book, $parameters);
    }

    public function flightFares(Common\Request\Parameters $parameters, string $provider, string $gds): FlightFares\Response
    {
        /** @var FlightFares\Response */
        return $this->query(Query::Fares, $parameters, $provider, $gds);
    }

    protected function query(Query $query, object $parameters, mixed ...$args): object
    {
        $violations = $this->validator->validate($parameters);

        if (count($violations)) {
            throw new ValidationFailedException($parameters, $violations);
        }

        $request = $query->newRequest($this->context, $parameters, ...$args);

        $body = $this->serializer->serialize($request, 'json');

        $response = $this->request($query->value, method: 'POST', body: $body);

        /** @var object */
        return $this->serializer->deserialize($response, $query->response(), 'json');
    }

    /**
     * @param array<string, string> $headers
     * @param string|array<string, string> $body
     *
     * @throws ClientExceptionInterface
     */
    protected function request(string $endpoint, array $headers = [], string $method = 'GET', string|array $body = ''): string
    {
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

        return (string) $this->httpClient->sendRequest($request)->getBody();
    }
}
