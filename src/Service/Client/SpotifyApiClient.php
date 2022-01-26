<?php
namespace App\Service\Client;

use App\SpotifyApiClientInterface;
use \GuzzleHttp\ClientInterface;
use \GuzzleHttp\Exception\RequestException;
use \GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\RequestStack;

class SpotifyApiClient {
    /**
     * @var string
     */
    private static $baseUrl = 'https://api.spotify.com';

    /**
     * @var GuzzleHttp\Client
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * 
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;

        // Obtiene el token de acceso guardado en sesión
        $session = $this->requestStack->getSession();
        $accessToken = $session->get('access_token');

        // if( $accessToken->hasExpired() ) {
        //     $accessToken = $client->refreshAccessToken($accessToken->getRefreshToken());

        //     // Update the stored access token for next time
        //     $session->set('access_token', $accessToken);
        // }         

        $this->setAccessToken($accessToken);
    }

    /**
     * Establecemos el token de acceso a la API de Spotify
     * 
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Permite hacer un request a la API de Spotify.
     * 
     * @param string $method
     * @param string $endpoint
     * @param array $params
     * @return mixed json bool
     */
    public function sendRequest($method, $endpoint, $params = [])
    {
        $query_params = '';
        
        if( !empty($params) ) {
            $query_params = http_build_query($params, '', '&');    
        }

        if( $endpoint ) {
            $request_url = $endpoint . ( ( !empty($query_params) ) ? '?' . $query_params : '' );

            $this->guzzleClient = new \GuzzleHttp\Client(["base_uri" => static::$baseUrl]);
            $response = $this->guzzleClient->request($method, $request_url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->accessToken)
                ]
            ]);

            $body = $response->getBody();
            $contents = ( !empty($body) ) ? $body->getContents() : '';

            return $contents;
        }

        return false;
    }    
}