<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GetGithubInfosController extends AbstractController
{

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function fetchGitHubInformation(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.github.com/repos/symfony/symfony-docs'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200

        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'

        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'

        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }

    #[Route('/get/github/infos', name: 'app_get_github_infos')]
    public function index(): Response
    {


        return $this->render('get_github_infos/index.html.twig', [
            'controller_name' => 'GetGithubInfosController', 'infoGithub' => $this->fetchGitHubInformation()
        ]);
    }
}
