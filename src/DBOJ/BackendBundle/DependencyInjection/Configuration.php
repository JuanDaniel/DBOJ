<?php

namespace DBOJ\BackendBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('backend');
        
        $rootNode->children()
                    ->arrayNode('dboj_engine')
                        ->info('engine configuration')
                        ->canBeEnabled()
                        ->children()
                            ->scalarNode('host')->defaultValue('localhost')->end()
                            ->scalarNode('port')->defaultValue(8081)->end()
                            ->scalarNode('host_db')->defaultValue('localhost')->end()
                            ->scalarNode('port_db')->defaultValue(5432)->end()
                            ->scalarNode('user_db')->defaultValue('postgres')->end()
                            ->scalarNode('password_db')->defaultValue(null)->end()
                            ->scalarNode('user_xmpp')->defaultValue('dboj_web')->end()
                            ->scalarNode('password_xmpp')->defaultValue(null)->end()
                        ->end()
                    ->end()
                    ->arrayNode('dboj_comunication')
                        ->info('comunication configuration')
                        ->canBeEnabled()
                        ->children()
                            ->scalarNode('host_xmpp')->defaultValue('localhost')->end()
                            ->scalarNode('port_xmpp')->defaultValue(null)->end()
                            ->scalarNode('user_xmpp')->defaultValue('dboj_comunication')->end()
                            ->scalarNode('password_xmpp')->defaultValue(null)->end()
                        ->end()
                    ->end()
                 ->end()
                ;

        return $treeBuilder;
    }
}
