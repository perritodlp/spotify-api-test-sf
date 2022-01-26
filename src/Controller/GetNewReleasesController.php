<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FrcH\SpotifyApiTestBundle\SpotifyApiClient;
use Symfony\Component\HttpFoundation\RequestStack;

class GetNewReleasesController extends AbstractController
{
    /**
     * Obtiene los 12 primeros lanzamientos de álbumes en Colombia, consultando la API de Spotify
     * 
     * @Route("/lanzamientos", name="get_new_releases")
     */
    public function index(RequestStack $requestStack): Response
    {
        // Instanciamos la clase que nos entrega un método para hacer peticiones a la API de Spotify 
        $spotifyApi = new SpotifyApiClient($requestStack);

        // Hacemos petición a los 15 primeros álbumes lanzados en el mercado Colombiano. 
        // Get New Releases: https://developer.spotify.com/documentation/web-api/reference/#/operations/get-new-releases
        $params = [
            'country' => 'CO',
            'limit' => 15,
            'offset' => 0
        ];

        $albums = $spotifyApi->sendRequest("GET", "/v1/browse/new-releases", $params);

        return $this->render('get_new_releases/index.html.twig', [
            'controller_name' => 'GetNewReleasesController',
            'albums' => json_decode($albums, true)
        ]);
    }
}
