<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Command;

use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

#[AsCommand('create:user')]
class CreateUserCommand extends Command
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserFactory $userFactory,
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $email = $io->ask('email', null, function (?string $input) {
            Assert::email($input, 'Invalid email value');

            return $input;
        });

        $password = $io->ask('password', null, function (?string $input) {
            Assert::notEmpty($input, 'Invalid password value');

            return $input;
        });

        $user = $this->userFactory->create($email, $password);
        $this->userRepository->add($user);

        return Command::SUCCESS;
    }
}
