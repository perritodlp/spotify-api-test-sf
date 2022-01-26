<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FrcH\SpotifyApiTestBundle\SpotifyApiClient;
use Symfony\Component\HttpFoundation\RequestStack;

class GetArtistInfoController extends AbstractController
{
    /**
     * Obtiene la información de un artista y sus álbumes, consultando la API de Spotify
     * 
     * @Route("/artista/{artistId}", name="get_artist_info")
     * @param Request $request
     */
    public function index(RequestStack $requestStack, Request $request, $artistId): Response
    {
        // Instanciamos la clase que nos entrega un método para hacer peticiones a la API de Spotify 
        $spotifyApi = new SpotifyApiClient($requestStack);

        // Hacemos petición a los datos del artista. 
        // Get Artist: https://developer.spotify.com/documentation/web-api/reference/#/operations/get-an-artist
        $artistInfo = $spotifyApi->sendRequest("GET", "/v1/artists/".$artistId, $array = []);

        // Hacemos petición a los álbumes del artista con presencia en el mercado Colombiano. 
        // Get Artist's Albums: https://developer.spotify.com/documentation/web-api/reference/#/operations/get-an-artists-albums
        $params = [
            'include_groups' => 'album,single,appears_on,compilation',
            'market' => 'CO'
        ];

        $albums = $spotifyApi->sendRequest("GET", "/v1/artists/".$artistId."/albums", $params);

        return $this->render('get_artist_info/index.html.twig', [
            'controller_name' => 'GetArtistInfoController',
            'artist' => json_decode($artistInfo, true),
            'albums' => json_decode($albums, true)
        ]);
    }
}
