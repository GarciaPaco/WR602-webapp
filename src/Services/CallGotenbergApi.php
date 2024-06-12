<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CallGotenbergApi
{
    private string $gotenbergAppUrl;
    public function __construct(string $gotenbergAppUrl)
    {
        $this->gotenbergAppUrl = $gotenbergAppUrl;
    }


    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function generatePdfFromUrl($url)
    {
        $client = httpClient::create();
        $response = $client->request('POST', $this->gotenbergAppUrl, [
            'headers' => [
                'Content-Type' => 'multipart/form-data',
            ],
            'body' => [
                'url' => $url,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception($response->getContent());
        } else {
            file_put_contents('my_pdf', $response->getContent());
            return $response->getContent();
        }
    }
}
