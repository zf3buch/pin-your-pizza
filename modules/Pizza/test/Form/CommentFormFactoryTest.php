<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Form;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Pizza\Form\CommentForm;
use Pizza\Form\CommentFormFactory;
use Pizza\Model\InputFilter\CommentInputFilter;

/**
 * Class CommentFormFactoryTest
 *
 * @package PizzaTest\Form
 */
class CommentFormFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var CommentInputFilter $inputFilter */
        $inputFilter = $this->prophesize(CommentInputFilter::class);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get(CommentInputFilter::class)
            ->willReturn($inputFilter)->shouldBeCalled();

        $expectedElementKeys = ['name', 'text', 'save_comment'];

        $factory = new CommentFormFactory();

        $this->assertTrue(
            $factory instanceof CommentFormFactory
        );

        /** @var CommentForm $form */
        $form = $factory($container->reveal());

        $this->assertTrue($form instanceof CommentForm);
        $this->assertEquals(
            $expectedElementKeys, array_keys($form->getElements())
        );
    }
}
