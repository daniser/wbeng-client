<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Exception;
use Http\Client\HttpAsyncClient;
use Http\Discovery\HttpAsyncClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Promise\Promise;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use TTBooking\WBEngine\DTO\Common;

class Client implements ClientInterface, AsyncClientInterface
{
    protected HttpClientInterface $httpClient;

    protected RequestFactoryInterface $requestFactory;

    protected StreamFactoryInterface $streamFactory;

    protected ValidatorInterface $validator;

    protected SerializerInterface $serializer;

    public function __construct(
        protected string $baseUri,
        protected Common\Query\Context $context,
        protected bool $legacy = true,
        HttpClientInterface $httpClient = null,
        protected ?HttpAsyncClient $httpAsyncClient = null,
        RequestFactoryInterface $requestFactory = null,
        StreamFactoryInterface $streamFactory = null,
        ValidatorInterface $validator = null,
        SerializerInterface $serializer = null,
        protected ?ContainerInterface $container = null,
    ) {
        $this->baseUri = rtrim($baseUri, '/');
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
        $this->validator = $validator ?? Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();
        $this->serializer = $serializer ?? SerializerFactory::discoverSerializer($legacy);
        $this->validate($context);
    }

    public function query(QueryInterface $query): StateInterface
    {
        return $this->buildState($query, $this->serializer->deserialize(
            (string) $this->httpClient->sendRequest($this->makeRequest($query))->getBody(),
            $query::getResultType()
        ));
    }

    public function asyncQuery(QueryInterface $query): Promise
    {
        return $this->sendAsyncRequest($this->makeRequest($query))->then(
            fn (ResponseInterface $response) => $this->buildState($query, $this->serializer->deserialize(
                (string) $response->getBody(),
                $query::getResultType()
            ))
        );
    }

    /**
     * @template TResult of ResultInterface
     *
     * @param QueryInterface<TResult> $query
     *
     * @phpstan-param TResult $result
     *
     * @return StateInterface<TResult>
     */
    protected function buildState(QueryInterface $query, ResultInterface $result): StateInterface
    {
        try {
            /** @var StateInterface<TResult> $state */
            $state = $this->container?->get(StateInterface::class) ?? new State;
        } catch (ContainerExceptionInterface) {
            /** @var State<TResult> $state */
            $state = new State;
        }

        return $state
            ->setBaseUri($this->baseUri)
            ->setLegacy($this->legacy)
            ->setQuery($query)
            ->setResult($result);
    }

    /**
     * @template TResult of ResultInterface
     *
     * @param QueryInterface<TResult> $query
     */
    protected function makeRequest(QueryInterface $query): RequestInterface
    {
        return $this->prepareRequest($query::getEndpoint(), method: 'POST', body: $this->serializer->serialize(
            $this->validate($query)->withContext($this->context)
        ));
    }

    /**
     * @template T
     *
     * @param T $entity
     *
     * @return T
     */
    protected function validate(mixed $entity): mixed
    {
        $violations = $this->validator->validate($entity);

        if (count($violations)) {
            throw new ValidationFailedException($entity, $violations);
        }

        return $entity;
    }

    /**
     * @param array<string, string>        $headers
     * @param array<string, string>|string $body
     */
    protected function prepareRequest(string $endpoint, array $headers = [], string $method = 'GET', array|string $body = ''): RequestInterface
    {
        $this->legacy && $endpoint .= '?legacy=on';
        $request = $this->requestFactory->createRequest($method, "$this->baseUri/$endpoint");

        $headers += ['Content-Type' => 'application/json'];
        foreach ($headers as $header => $value) {
            $request = $request->withHeader($header, $value);
        }

        if ($body) {
            $stream = $this->streamFactory->createStream(is_array($body) ? http_build_query($body) : $body);
            $request = $request->withBody($stream);
        }

        return $request;
    }

    /**
     * @return Promise<ResponseInterface>
     *
     * @throws Exception
     */
    protected function sendAsyncRequest(RequestInterface $request): Promise
    {
        $this->httpAsyncClient ??= HttpAsyncClientDiscovery::find();

        return $this->httpAsyncClient->sendAsyncRequest($request);
    }
}
