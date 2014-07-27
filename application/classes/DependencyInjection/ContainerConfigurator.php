<?php

namespace App\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContainerConfigurator
{
    public function configure()
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(APPPATH . 'config/services/'));
        $loader->load('services.yml');

        return $container;
    }
}
