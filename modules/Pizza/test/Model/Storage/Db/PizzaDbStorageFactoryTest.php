<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Storage\Db;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Model\Storage\Db\PizzaDbStorage;
use Pizza\Model\Storage\Db\PizzaDbStorageFactory;
use Pizza\Model\Storage\PizzaStorageInterface;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class PizzaStorageFactoryTest
 *
 * @package PizzaTest\Model\Storage\Db
 */
class PizzaStorageFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var PizzaStorageInterface $pizzaStorage */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(AdapterInterface::class)->willReturn($dbAdapter)
            ->shouldBeCalled();

        $factory = new PizzaDbStorageFactory();

        /** @var PizzaDbStorage $storage */
        $storage = $factory($container->reveal());

        $this->assertTrue($storage instanceof PizzaDbStorage);
    }
}
