<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class SpotifyController extends AbstractController
{
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * Este controlador inicia el proceso de "conectarse" a la API de Spotify.
     * El proceso a usar fue el "Authorization Code Flow": https://developer.spotify.com/documentation/general/guides/authorization/code-flow
     *
     * @Route("/", name="connect_spotify_start")
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        // Se redirigirá a Spotify!
        return $clientRegistry
            ->getClient('spotify') // llave usada en config/packages/knpu_oauth2_client.yaml
            ->redirect([
	    	    'playlist-read-private' // los scopes a los que se desea ingresar
            ]);
    }

    /**
     * Después de ir a Spotify y autorizar el ingreso (usuario y clave de Spotify), será redireccionado de regreso aquí,
     * porque esta es la "redirect_route" configurada en config/packages/knpu_oauth2_client.yaml
     * 
     * @Route("/connect/spotify/check", schemes={"http"}, name="connect_spotify_check")
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {
        /** @var \KnpU\OAuth2ClientBundle\Client\Provider\spotifyClient $client */
        $client = $clientRegistry->getClient('spotify');

        try {
            // Obtenemos la sesión
            $session = $this->requestStack->getSession();    

            // Obtenemos el token de acceso y lo guardamos en una variable de sesión
            $accessToken = $client->getAccessToken();
            $session->set('access_token', $accessToken);

            // Si el token ha expirado, se intenta refrescarlo
            if ($accessToken->hasExpired()) {
                $accessToken = $client->refreshAccessToken($accessToken->getRefreshToken());

                // Actualiza el token de acceso guardado, para usarlo la siguente vez
                $session->set('access_token', $accessToken);
            }            

            return $this->redirectToRoute('get_new_releases');

        } catch (IdentityProviderException $e) {
            // Upss.. Algo estuvo mal. Probablemente deberíamos retornarle la razón al usuario, 
            // manejando el error y presentarlo de mejor manera.
            var_dump($e->getMessage()); die;
        }
    }
}