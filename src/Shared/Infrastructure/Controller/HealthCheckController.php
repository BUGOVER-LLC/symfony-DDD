<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controller;

use OpenApi\Attributes as OA;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/health-check', name: 'health-check', methods: ['GET'])]
#[OA\Response(
    response: 200,
    description: 'Returns the rewards',
    content: new OA\JsonContent(properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
            default: 'success',
        ),
        new OA\Property(
            property: 'data',
            type: 'object',
            default: [],
        ),
    ])
)]
#[OA\Tag(name: 'health')]
class HealthCheckController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return $this->json([
            'message' => 'success',
            'data' => (new stdClass()),
        ]);
    }
}
