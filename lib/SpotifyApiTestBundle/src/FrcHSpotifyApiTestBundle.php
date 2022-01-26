<?php

namespace FrcH\SpotifyApiTestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use FrcH\SpotifyApiTestBundle\DependencyInjection\FrcHSpotifyApiTestExtension;

class FrcHSpotifyApiTestBundle extends Bundle 
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FrcHSpotifyApiTestExtension();
        }

        return $this->extension;
    }
}