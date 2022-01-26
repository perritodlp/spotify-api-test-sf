<?php

namespace FrcH\SpotifyApiTestBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class FrcHSpotifyApiTestExtension extends Extension 
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
        
        $definition = $container->getDefinition('frch_spotify_api_test.spotify_api_client');
        $definition->setArgument(0, 'frch');
        // $definition->setArgument(1, 'another');
    }

    public function getAlias()
    {
        return 'frch_spotify_api_test';
    }
}