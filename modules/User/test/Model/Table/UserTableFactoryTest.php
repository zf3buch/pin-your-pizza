<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Model\Table;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use User\Model\Table\UserTable;
use User\Model\Table\UserTableFactory;
use User\Model\Table\UserTableInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class UserTableFactoryTest
 *
 * @package UserTest\Model\Table
 */
class UserTableFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var UserTableInterface $userTable */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var MethodProphecy $method */
        $method = $container->get(AdapterInterface::class);
        $method->willReturn($dbAdapter);
        $method->shouldBeCalled();

        $factory = new UserTableFactory();

        $this->assertTrue(
            $factory instanceof UserTableFactory
        );

        /** @var UserTable $table */
        $table = $factory($container->reveal());

        $this->assertTrue($table instanceof UserTable);
    }
}
