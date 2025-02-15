<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Security;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Security\UserGetterInterface;
use Override;
use PHPUnit\Framework\Assert;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

use function get_class;
use function sprintf;

class AuthUser implements UserGetterInterface
{
    public function __construct(private readonly Security $security, private readonly TranslatorInterface $translator)
    {
    }

    #[Override] public function getAuthUser(): AuthUserInterface
    {
        $user = $this->security->getUser();

        Assert::assertNotNull($user, $this->translator->trans('unauthenticated'));
        Assert::assertInstanceOf(
            AuthUserInterface::class,
            $user,
            sprintf('invalid user type %s', get_class($user))
        );

        return $user;
    }
}
