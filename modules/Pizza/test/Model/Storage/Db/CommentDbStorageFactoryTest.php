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
use Pizza\Model\Storage\CommentStorageInterface;
use Pizza\Model\Storage\Db\CommentDbStorage;
use Pizza\Model\Storage\Db\CommentDbStorageFactory;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class CommentStorageFactoryTest
 *
 * @package PizzaTest\Model\Storage\Db
 */
class CommentStorageFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var CommentStorageInterface $CommentStorage */
        $dbAdapter = $this->prophesize(AdapterInterface::class);

        /** @var ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        $container->get(AdapterInterface::class)->willReturn($dbAdapter)
            ->shouldBeCalled();

        $factory = new CommentDbStorageFactory();

        /** @var CommentDbStorage $storage */
        $storage = $factory($container->reveal());

        $this->assertTrue($storage instanceof CommentDbStorage);
    }
}
