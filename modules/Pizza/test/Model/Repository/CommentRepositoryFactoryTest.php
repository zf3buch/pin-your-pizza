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
use Pizza\Model\Repository\CommentRepository;
use Pizza\Model\Repository\CommentRepositoryFactory;
use Pizza\Model\Storage\CommentStorageInterface;

/**
 * Class CommentRepositoryFactoryTest
 *
 * @package PizzaTest\Model\Repository
 */
class CommentRepositoryFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var CommentStorageInterface $commentTable */
        $commentTable = $this->prophesize(
            CommentStorageInterface::class
        );

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(CommentStorageInterface::class)
            ->willReturn($commentTable)->shouldBeCalled();

        $factory = new CommentRepositoryFactory();

        /** @var CommentRepository $repository */
        $repository = $factory($container->reveal());

        $this->assertTrue($repository instanceof CommentRepository);
    }
}
