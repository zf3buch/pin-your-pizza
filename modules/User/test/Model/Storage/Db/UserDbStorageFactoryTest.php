<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Model\Storage\Db;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use User\Model\Storage\Db\UserDbStorage;
use User\Model\Storage\Db\UserDbStorageFactory;
use User\Model\Storage\UserStorageInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class UserDbStorageFactoryTest
 *
 * @package UserTest\Model\Storage\Db
 */
class UserDbStorageFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var UserStorageInterface $userStorage */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(AdapterInterface::class)->willReturn($dbAdapter)
            ->shouldBeCalled();

        $factory = new UserDbStorageFactory();

        /** @var UserDbStorage $storage */
        $storage = $factory($container->reveal());

        $this->assertTrue($storage instanceof UserDbStorage);
    }
}
