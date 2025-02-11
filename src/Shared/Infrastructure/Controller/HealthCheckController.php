<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController extends AbstractController
{
    #[Route(path: '/health-check', name: 'health-check', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return $this->json([]);
    }
}
