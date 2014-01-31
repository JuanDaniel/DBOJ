<?php

namespace DBOJ\BackendBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BackendExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        //Engine configuration
        $container->setParameter('backend.engine.host', $config['dboj_engine']['host']);
        $container->setParameter('backend.engine.port', $config['dboj_engine']['port']);
        $container->setParameter('backend.engine.host_db', $config['dboj_engine']['host_db']);
        $container->setParameter('backend.engine.port_db', $config['dboj_engine']['port_db']);
        $container->setParameter('backend.engine.user_db', $config['dboj_engine']['user_db']);
        $container->setParameter('backend.engine.password_db', $config['dboj_engine']['password_db']);
        $container->setParameter('backend.engine.user_xmpp', $config['dboj_engine']['user_xmpp']);
        $container->setParameter('backend.engine.password_xmpp', $config['dboj_engine']['password_xmpp']);
        
        //Comunication configuration
        $container->setParameter('backend.comunication.host_xmpp', $config['dboj_comunication']['host_xmpp']);
        $container->setParameter('backend.comunication.port_xmpp', $config['dboj_comunication']['port_xmpp']);
        $container->setParameter('backend.comunication.user_xmpp', $config['dboj_comunication']['user_xmpp']);
        $container->setParameter('backend.comunication.password_xmpp', $config['dboj_comunication']['password_xmpp']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
