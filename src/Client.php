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
use TTBooking\WBEngine\DTO\Air\Common;
use TTBooking\WBEngine\DTO\Air\CreateBooking;
use TTBooking\WBEngine\DTO\Air\FlightFares;
use TTBooking\WBEngine\DTO\Air\SearchFlights;
use TTBooking\WBEngine\DTO\Air\SelectFlight;

class Client implements ClientInterface
{
    public function __construct(
        protected string $baseUri,
        protected Common\Request\Context $context,
        protected ?HttpClientInterface $httpClient = null,
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

    public function searchFlights(SearchFlights\Request\Parameters $query): SearchFlights\Response
    {
        $request = new SearchFlights\Request($this->context, $query);

        $body = $this->serializer->serialize($request, 'json');

        $response = $this->request('flights', method: 'POST', body: $body);

        return $this->serializer->deserialize($response, SearchFlights\Response::class, 'json');
    }

    public function selectFlight(Common\Request\Parameters $query): SelectFlight\Response
    {
        $request = new Common\Request($this->context, $query);

        $body = $this->serializer->serialize($request, 'json');

        $response = $this->request('price', method: 'POST', body: $body);

        return $this->serializer->deserialize($response, SelectFlight\Response::class, 'json');
    }

    public function createBooking(CreateBooking\Request\Parameters $query): CreateBooking\Response
    {
        $request = new CreateBooking\Request($this->context, $query);

        $body = $this->serializer->serialize($request, 'json');

        $response = $this->request('book', method: 'POST', body: $body);

        return $this->serializer->deserialize($response, CreateBooking\Response::class, 'json');
    }

    public function flightFares(Common\Request\Parameters $query, string $provider, string $gds): FlightFares\Response
    {
        $request = new FlightFares\Request($this->context, $query, $provider, $gds);

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
