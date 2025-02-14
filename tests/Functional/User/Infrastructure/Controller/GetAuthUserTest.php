<?php

declare(strict_types=1);

namespace App\Tests\Functional\User\Infrastructure\Controller;

use App\Tests\Resource\Tools\FixtureTool;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

use function sprintf;

class GetAuthUserTest extends WebTestCase
{
    use FixtureTool;

    /**
     * @throws JsonException
     */
    public function test_get_me_successfully(): void
    {
        $client = self::createClient();
        $user = $this->loadUserFixture();

        $client->request(
            method: Request::METHOD_GET,
            uri: '/api/auth/v1/login',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
            ], JSON_THROW_ON_ERROR)
        );
        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);

        $data = json_decode($client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $client->setServerParameter('HTTP_AUTHORIZATION', sprintf('Bearer %s', $data['token']));
        $client->request(Request::METHOD_GET, '/api/user/me');
        $clientMeData = json_decode($client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);
        self::assertEquals($user->getEmail(), $clientMeData['email']);
    }
}
