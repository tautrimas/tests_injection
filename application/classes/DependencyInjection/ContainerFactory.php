<?php

namespace App\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContainerFactory
{
    /**
     * @return ContainerInterface
     */
    public static function create()
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(APPPATH . 'config/services/'));
        $loader->load('services.yml');
        $container->compile();

        return $container;
    }
}
