<?php

declare(strict_types=1);

namespace App\Tests\Functional\User\Application\Query;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\Resource\Tools\FakerTool;
use App\Tests\Resource\Tools\FixtureTool;
use App\User\Application\DTO\UserDto;
use App\User\Application\Query\FindUser\FindUserByEmailQuery;
use App\User\Domain\Repository\UserRepositoryInterafce;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\ORMDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use function PHPUnit\Framework\assertInstanceOf;

/**
 * @link FindUserByEmailQueryHandler
 */
class FindUserByEmailQueryHandlerTest extends WebTestCase
{
    use FakerTool;
    use FixtureTool;

    /**
     * @var QueryBusInterface
     */
    private QueryBusInterface $queryBus;

    /**
     * @var UserRepositoryInterafce
     */
    private UserRepositoryInterafce $userRepository;

    /**
     * @var ORMDatabaseTool
     */
    private ORMDatabaseTool $databaseTool;

    public function test_user_command_executed(): void
    {
        $user = $this->loadUserFixture();
        $query = new FindUserByEmailQuery($user->getEmail());
        $userDTO = $this->queryBus->execute($query);

        assertInstanceOf(UserDto::class, $userDTO);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->queryBus = self::getContainer()->get(QueryBusInterface::class);
        $this->userRepository = self::getContainer()->get(UserRepositoryInterafce::class);
        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }
}
