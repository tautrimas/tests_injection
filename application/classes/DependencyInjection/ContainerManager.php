<?php

namespace App\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Stores service container instance
 */
class ContainerManager
{
    /**
     * @var ContainerInterface
     */
    protected static $container;

    /**
     * Prepare container
     */
    public static function initialize()
    {
        $container = ContainerFactory::create();
        static::$container = $container;
    }

    /**
     * Return container
     *
     * @return ContainerInterface
     */
    public static function get()
    {
        return static::$container;
    }
}
