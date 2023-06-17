<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Enum\ParkingLotActionEnum;
use App\Application\Exception\ValidationException;
use App\Application\Service\ParkingLotAvailabilityServiceInterface;
use App\Application\Service\ParkingLotManagerServiceInterface;
use App\Application\Validator\AvailabilityValidator;
use App\Application\Validator\CheckInValidator;
use App\Application\Validator\CheckOutValidator;
use App\Application\ValueObject\VehicleData;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'parking-lot:manager',
    description: 'Run the parking lot\'s manager application'
)]
class InMemoryParkingLotManagerCommand extends Command implements ParkingLotManagerCommandInterface
{
    public function __construct(
        protected readonly ParkingLotAvailabilityServiceInterface $parkingLotAvailabilityService,
        protected readonly ParkingLotManagerServiceInterface $parkingLotManagerService,
        protected readonly AvailabilityValidator $availabilityValidator,
        protected readonly CheckInValidator $checkInValidator,
        protected readonly CheckOutValidator $checkOutValidator,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->block(messages: '[PL] PARKING LOTS ®', style: 'fg=white;bg=blue', padding: true);

        $io->block(
            messages: "Welcome to our parking lot!\nNo stress, just park your vehicle and leave the rest with us 😉",
            style: 'fg=blue;bg=white',
            padding: true
        );

        $action = $io->choice(
            'Please select an action',
            [ParkingLotActionEnum::CHECK_IN->value, ParkingLotActionEnum::CHECK_OUT->value]
        );

        try {
            match ($action) {
                ParkingLotActionEnum::CHECK_IN->value => $this->handleCheckIn($io),
                ParkingLotActionEnum::CHECK_OUT->value => $this->handleCheckout($io),
                default => throw new \LogicException('An action must be selected'),
            };
        } catch (ValidationException $exception) {
            $io->block(messages: $exception->getMessage(), style: 'fg=white;bg=red', padding: true);
        }

        $keepRunning = $io->confirm('Keep running manager?');

        if ($keepRunning) {
            $this->execute($input, $output);
        }

        return Command::SUCCESS;
    }

    protected function handleCheckIn(SymfonyStyle $io): void
    {
        $availability = $this->parkingLotAvailabilityService->getAvailability();
        $totalSpotsCount = $availability->getTotalSpotsCount();
        $availableSpotsCount = $availability->getAvailableSpotsCount();

        $this->availabilityValidator->validate();

        $io->block(
            messages: "Availability: [$availableSpotsCount/$totalSpotsCount]",
            padding: true
        );

        $licensePlate = $io->ask('What is your license plate?');

        $vehicleData = new VehicleData($licensePlate);

        $this->checkInValidator->validate($vehicleData);

        $this->parkingLotManagerService->checkIn($vehicleData);

        $io->block(messages: 'Please go in!', style: 'fg=black;bg=green', padding: true);
    }

    protected function handleCheckout(SymfonyStyle $io): void
    {
        $licensePlate = $io->ask('What is your license plate?');

        $vehicleData = new VehicleData($licensePlate);

        $this->checkOutValidator->validate($vehicleData);

        $this->parkingLotManagerService->checkOut($vehicleData);

        $io->block(messages: 'Thank you for parking with us!', style: 'fg=black;bg=green', padding: true);
    }
}
