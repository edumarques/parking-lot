<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Infrastructure\DependencyInjection\ServiceContainer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class AbstractFunctionalTest extends TestCase
{
    protected static ContainerBuilder $container;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$container = ServiceContainer::load();
    }
}
