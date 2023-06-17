<?php

declare(strict_types=1);

namespace App\Infrastructure\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

final class ServiceContainer
{
    private static ContainerBuilder $container;

    public static function load(): ContainerBuilder
    {
        self::createContainer();
        self::registerParameters();
        self::registerServices();

        return self::$container;
    }

    private static function createContainer(): void
    {
        if (isset(self::$container)) {
            return;
        }

        self::$container = new ContainerBuilder();
    }

    private static function registerParameters(): void
    {
        if (false === isset(self::$container)) {
            return;
        }

        foreach (self::getParameterDefinitions() as $name => $value) {
            self::$container->setParameter($name, $value);
        }
    }

    private static function registerServices(): void
    {
        if (false === isset(self::$container)) {
            return;
        }

        self::$container->setDefinitions(self::getServiceDefinitions());
    }

    private static function getParameterDefinitions(): array
    {
        return require_once __DIR__ . '/../../../config/parameters';
    }

    private static function getServiceDefinitions(): array
    {
        return require_once __DIR__ . '/../../../config/services';
    }

    final private function __construct()
    {
    }
}
