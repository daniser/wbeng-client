<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use TTBooking\WBEngine\DTO\Air\Common\RequestContext;
use TTBooking\WBEngine\DTO\Air\FlightFares;
use TTBooking\WBEngine\DTO\Air\SearchFlights;

class Client
{
    public function __construct(
        protected string $baseUri,
        protected RequestContext $context,
        protected ?ClientInterface $httpClient = null,
        protected ?RequestFactoryInterface $requestFactory = null,
        protected ?StreamFactoryInterface $streamFactory = null,
        protected ?SerializerInterface $serializer = null,
    ) {
        $this->baseUri = rtrim($baseUri, '/');
        $this->httpClient ??= Psr18ClientDiscovery::find();
        $this->requestFactory ??= Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory ??= Psr17FactoryDiscovery::findStreamFactory();
        $this->serializer ??= SerializerBuilder::create()
            ->enableEnumSupport()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy)
            ->build();
    }

    public function searchFlights(SearchFlights\Request\Parameters $parameters): SearchFlights\Response
    {
        $request = new SearchFlights\Request($this->context, $parameters);

        $body = $this->serializer->serialize($request, 'json');

        $response = $this->request('flights', method: 'POST', body: $body);

        return $this->serializer->deserialize($response, SearchFlights\Response::class, 'json');
    }

    public function flightFares(FlightFares\Request\Parameters $parameters, string $provider, string $gds): FlightFares\Response
    {
        $request = new FlightFares\Request($this->context, $parameters, $provider, $gds);

        $body = $this->serializer->serialize($request, 'json');

        $response = $this->request('flightfares', method: 'POST', body: $body);

        return $this->serializer->deserialize($response, FlightFares\Response::class, 'json');
    }

    /**
     * @throws ClientExceptionInterface
     */
    protected function request(
        string $endpoint,
        array $headers = [],
        string $method = 'GET',
        string|array $body = '',
    ): string {
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
