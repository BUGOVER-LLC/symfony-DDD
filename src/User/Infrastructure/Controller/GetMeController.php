<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class GetMeController extends AbstractController
{
    public function __construct(private readonly Security $security)
    {
    }

    #[Route('/api/user/me', name: 'auth_user', methods: [Request::METHOD_GET])]
    public function __invoke(): JsonResponse
    {
        $user = $this->security->getUser();

        return $this->json([
            'id' => $user?->getUlid(),
            'email' => $user?->getEmail(),
        ]);
    }
}
