<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Table;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Model\Table\PizzaTable;
use Pizza\Model\Table\PizzaTableFactory;
use Pizza\Model\Table\PizzaTableInterface;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class PizzaTableFactoryTest
 *
 * @package PizzaTest\Model\Table
 */
class PizzaTableFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var PizzaTableInterface $pizzaTable */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var MethodProphecy $method */
        $method = $container->get(AdapterInterface::class);
        $method->willReturn($dbAdapter);
        $method->shouldBeCalled();

        $factory = new PizzaTableFactory();

        $this->assertTrue(
            $factory instanceof PizzaTableFactory
        );

        /** @var PizzaTable $table */
        $table = $factory($container->reveal());

        $this->assertTrue($table instanceof PizzaTable);
    }
}
