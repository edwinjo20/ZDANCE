<?php

namespace App\Controller;

use League\OAuth2\Client\Provider\GenericProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpotifyController extends AbstractController
{
    private function getSpotifyProvider()
    {
        return new GenericProvider([
            'clientId'                => $_ENV['SPOTIFY_CLIENT_ID'],
            'clientSecret'            => $_ENV['SPOTIFY_CLIENT_SECRET'],
            'redirectUri'             => $_ENV['SPOTIFY_REDIRECT_URI'],
            'urlAuthorize'            => 'https://accounts.spotify.com/authorize',
            'urlAccessToken'          => 'https://accounts.spotify.com/api/token',
            'urlResourceOwnerDetails' => 'https://api.spotify.com/v1/me'
        ]);
    }

    #[Route('/connect/spotify', name: 'connect_spotify')]
    public function connect()
    {
        $provider = $this->getSpotifyProvider();
        $authUrl = $provider->getAuthorizationUrl();
        return $this->redirect($authUrl);
    }

    #[Route('/callback', name: 'spotify_callback')]
    public function callback(Request $request)
    {
        $provider = $this->getSpotifyProvider();

        if (!$request->query->get('code')) {
            return new Response("Erreur : aucun code reçu", Response::HTTP_BAD_REQUEST);
        }

        $token = $provider->getAccessToken('authorization_code', [
            'code' => $request->query->get('code')
        ]);

        $user = $provider->getResourceOwner($token);

        return new Response("Utilisateur connecté : " . $user->getId());
    }
}