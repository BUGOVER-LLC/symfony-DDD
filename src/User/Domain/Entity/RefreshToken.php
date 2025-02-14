<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use DateTimeImmutable;

class RefreshToken
{
    private int $id;

    private string $refreshToken;

    private string $username;

    private DateTimeImmutable $valid;
}
