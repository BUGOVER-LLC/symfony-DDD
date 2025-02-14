<?php

declare(strict_types=1);

namespace App\Tests\Resource\Tools;

use App\Tests\Resource\Fixtures\UserFixture;
use App\User\Domain\Entity\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

trait FixtureTool
{
    public function loadUserFixture()
    {
        $executor = $this->getDatabaseTool()->loadFixtures([UserFixture::class]);

        return $executor->getReferencerepository()->getReference(UserFixture::REFERENCE, User::class);
    }

    public function getDatabaseTool()
    {
        return static::getContainer()->get(DatabaseToolCollection::class)->get();
    }
}
