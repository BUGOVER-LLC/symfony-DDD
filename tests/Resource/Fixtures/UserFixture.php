<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixtures;

use App\Tests\Resource\Tools\FakerTool;
use App\User\Domain\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    use FakerTool;

    public const string REFERENCE = 'user';

    #[\Override] public function load(ObjectManager $manager): void
    {
        $user = (new UserFactory())->create($this->getFaker()->email(), $this->getFaker()->password(32, 32));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::REFERENCE, $user);
    }
}
