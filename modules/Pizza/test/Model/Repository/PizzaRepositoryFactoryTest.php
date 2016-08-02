<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Repository;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Model\Repository\PizzaRepository;
use Pizza\Model\Repository\PizzaRepositoryFactory;
use Pizza\Model\Storage\CommentStorageInterface;
use Pizza\Model\Storage\PizzaStorageInterface;

/**
 * Class PizzaRepositoryFactoryTest
 *
 * @package PizzaTest\Model\Repository
 */
class PizzaRepositoryFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var PizzaStorageInterface $pizzaTable */
        $pizzaTable = $this->prophesize(PizzaStorageInterface::class);

        /** @var CommentStorageInterface $commentTable */
        $commentTable = $this->prophesize(
            CommentStorageInterface::class
        );

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(PizzaStorageInterface::class)
            ->willReturn($pizzaTable)->shouldBeCalled();
        $container->get(CommentStorageInterface::class)
            ->willReturn($commentTable)->shouldBeCalled();

        $factory = new PizzaRepositoryFactory();

        $this->assertTrue(
            $factory instanceof PizzaRepositoryFactory
        );

        /** @var PizzaRepository $repository */
        $repository = $factory($container->reveal());

        $this->assertTrue($repository instanceof PizzaRepository);
    }
}
