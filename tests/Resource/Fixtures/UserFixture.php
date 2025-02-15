<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixtures;

use App\Tests\Resource\Tools\FakerTool;
use App\User\Domain\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Override;

class UserFixture extends Fixture
{
    use FakerTool;

    public const string REFERENCE = 'user';

    public function __construct(private readonly UserFactory $userFactory)
    {
    }

    #[Override] public function load(ObjectManager $manager): void
    {
        $user = $this->userFactory->create($this->getFaker()->email(), $this->getFaker()->password(32, 32));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::REFERENCE, $user);
    }
}
