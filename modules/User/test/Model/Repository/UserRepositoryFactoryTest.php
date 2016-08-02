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
use User\Model\Storage\UserStorageInterface;

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
        /** @var UserStorageInterface $userStorage */
        $userStorage = $this->prophesize(UserStorageInterface::class);

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(UserStorageInterface::class)
            ->willReturn($userStorage)->shouldBeCalled();

        $factory = new UserRepositoryFactory();

        /** @var UserRepository $repository */
        $repository = $factory($container->reveal());

        $this->assertTrue($repository instanceof UserRepository);
    }
}
