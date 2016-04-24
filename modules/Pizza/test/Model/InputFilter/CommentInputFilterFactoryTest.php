<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\InputFilter;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Model\InputFilter\CommentInputFilter;
use Pizza\Model\InputFilter\CommentInputFilterFactory;

/**
 * Class CommentInputFilterFactoryTest
 *
 * @package PizzaTest\Model\InputFilter
 */
class CommentInputFilterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        $container = $this->prophesize(ContainerInterface::class);

        $expectedInputKeys = ['name', 'text'];

        $factory = new CommentInputFilterFactory();

        $this->assertTrue(
            $factory instanceof CommentInputFilterFactory
        );

        /** @var CommentInputFilter $inputFilter */
        $inputFilter = $factory($container->reveal());

        $this->assertTrue($inputFilter instanceof CommentInputFilter);
        $this->assertEquals(
            $expectedInputKeys, array_keys($inputFilter->getInputs())
        );
    }
}
