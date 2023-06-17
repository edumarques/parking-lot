<?php

declare(strict_types=1);

namespace App\Tests\Functional\Application\Command;

use App\Application\Command\ParkingLotManagerCommandInterface;
use App\Application\Enum\ParkingLotActionEnum;
use App\Infrastructure\Database\DatabaseLoaderInterface;
use App\Infrastructure\Database\InMemoryDatabaseLoader;
use App\Tests\Functional\AbstractFunctionalTest;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class InMemoryParkingLotManagerCommandTest extends AbstractFunctionalTest
{
    private CommandTester $command;

    public function testCheckInWhenThereAreSpotsAvailable(): void
    {
        $this->command->setInputs(
            [
                ParkingLotActionEnum::CHECK_IN->value,
                '123456',
                'no',
            ]
        );

        $this->command->execute([]);

        $this->command->assertCommandIsSuccessful();

        $display = $this->command->getDisplay();

        $this->assertStringContainsString('Please go in', $display);
    }

    public function testCheckInWhenThereAreNoSpotsAvailable(): void
    {
        $this->command->setInputs(
            [
                ParkingLotActionEnum::CHECK_IN->value,
                '123456',
                'yes',
                ParkingLotActionEnum::CHECK_IN->value,
                '654321',
                'yes',
                ParkingLotActionEnum::CHECK_IN->value,
                'no',
            ]
        );

        $this->command->execute([]);

        $this->command->assertCommandIsSuccessful();

        $display = $this->command->getDisplay();

        $this->assertStringContainsString('Sorry, no place left', $display);
    }

    public function testCheckInWithLicensePlateAlreadyCheckedIn(): void
    {
        $this->command->setInputs(
            [
                ParkingLotActionEnum::CHECK_IN->value,
                '123456',
                'yes',
                ParkingLotActionEnum::CHECK_IN->value,
                '123456',
                'no',
            ]
        );

        $this->command->execute([]);

        $this->command->assertCommandIsSuccessful();

        $display = $this->command->getDisplay();

        $this->assertStringContainsString('This license plate is already registered as parked here', $display);
    }

    public function testCheckOutWithVehicleNotCheckedIn(): void
    {
        $this->command->setInputs(
            [
                ParkingLotActionEnum::CHECK_IN->value,
                '123456',
                'yes',
                ParkingLotActionEnum::CHECK_OUT->value,
                '456789',
                'no',
            ]
        );

        $this->command->execute([]);

        $this->command->assertCommandIsSuccessful();

        $display = $this->command->getDisplay();

        $this->assertStringContainsString('This license plate is not registered as parked here', $display);
    }

    public function testCheckOutWhenParkingLotIsFullEnablingCheckIn(): void
    {
        $this->command->setInputs(
            [
                ParkingLotActionEnum::CHECK_IN->value,
                '123456',
                'yes',
                ParkingLotActionEnum::CHECK_IN->value,
                '654321',
                'yes',
                ParkingLotActionEnum::CHECK_OUT->value,
                '123456',
                'yes',
                ParkingLotActionEnum::CHECK_IN->value,
                '456789',
                'no',
            ]
        );

        $this->command->execute([]);

        $this->command->assertCommandIsSuccessful();

        $display = $this->command->getDisplay();

        $this->assertStringContainsString('Please go in', $display);
        $this->assertStringContainsString('Thank you for parking with us!', $display);
        $this->assertStringNotContainsString('Sorry, no place left', $display);
    }


    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var InMemoryDatabaseLoader $inMemoryDatabaseLoader */
        $inMemoryDatabaseLoader = self::$container->get(DatabaseLoaderInterface::class);
        $inMemoryDatabaseLoader->load();

        $command = self::$container->get(ParkingLotManagerCommandInterface::class);

        $application = new Application();
        $application->add($command);

        $this->command = new CommandTester($command);
    }


    /**
     * @throws \Exception
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        /** @var InMemoryDatabaseLoader $inMemoryDatabaseLoader */
        $inMemoryDatabaseLoader = self::$container->get(DatabaseLoaderInterface::class);
        $inMemoryDatabaseLoader->drop();
    }
}
