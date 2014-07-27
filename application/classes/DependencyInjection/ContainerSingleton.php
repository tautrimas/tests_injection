<?php

namespace App\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerSingleton
{
    /**
     * @var ContainerInterface
     */
    protected static $container;

    public static function initialize()
    {
        $container = (new ContainerConfigurator())->configure();
        static::$container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public static function get()
    {
        return static::$container;
    }
}
