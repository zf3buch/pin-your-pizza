<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Model\Repository;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use User\Model\Repository\UserRepository;
use User\Model\Repository\UserRepositoryFactory;
use User\Model\Table\UserTableInterface;
use Prophecy\Prophecy\MethodProphecy;

/**
 * Class UserRepositoryFactoryTest
 *
 * @package UserTest\Model\Repository
 */
class UserRepositoryFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var UserTableInterface $userTable */
        $userTable = $this->prophesize(UserTableInterface::class);

        /** @var MethodProphecy $method */
        $method = $container->get(UserTableInterface::class);
        $method->willReturn($userTable);
        $method->shouldBeCalled();

        $factory = new UserRepositoryFactory();

        $this->assertTrue(
            $factory instanceof UserRepositoryFactory
        );

        /** @var UserRepository $repository */
        $repository = $factory($container->reveal());

        $this->assertTrue($repository instanceof UserRepository);
    }
}
