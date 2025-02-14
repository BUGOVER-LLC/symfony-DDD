<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Service\UlidService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class User implements AuthUserInterface
{
    private string $ulid;
    private string $email;
    private ?string $password;

    public function __construct(string $email)
    {
        $this->ulid = UlidService::generate();
        $this->email = $email;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password, UserPasswordHasherInterface $passwordHasher): void
    {
        $this->password = $passwordHasher->hashPassword($this, $password);
    }

    #[\Override] public function getRoles(): array
    {
        return [
            'ROLE_USER',
        ];
    }

    #[\Override] public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    #[\Override] public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
