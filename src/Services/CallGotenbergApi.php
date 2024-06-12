<?php

namespace App\Services;

class CallGotenbergApi
{
    private string $gotenbergAppUrl;
    public function __construct(string $gotenbergAppUrl)
    {
        $this->gotenbergAppUrl = $gotenbergAppUrl;
    }


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
            throw new \Exception('Gotenberg API error');
        } else {
            file_put_contents('my_pdf', $response->getContent());
            return $response->getContent();
        }
    }
}