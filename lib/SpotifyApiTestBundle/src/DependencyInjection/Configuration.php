<?php

namespace FrcH\SpotifyApiTestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('frch');
        $rootNode = $treeBuilder->getRootNode('frch_spotify_api_test');

        $rootNode
            ->children()
                ->booleanNode('frch')->defaultTrue()->info('Test configuration')->end()
            ->end()    
        ;

        return $treeBuilder;
    }
}