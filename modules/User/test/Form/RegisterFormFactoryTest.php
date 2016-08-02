<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Form;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use User\Form\RegisterForm;
use User\Form\RegisterFormFactory;
use User\Model\InputFilter\RegisterInputFilter;

/**
 * Class RegisterFormFactoryTest
 *
 * @package UserTest\Form
 */
class RegisterFormFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        /** @var RegisterInputFilter $inputFilter */
        $inputFilter = $this->prophesize(RegisterInputFilter::class);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get(RegisterInputFilter::class)
            ->willReturn($inputFilter)->shouldBeCalled();

        $expectedElementKeys = [
            'email',
            'password',
            'first_name',
            'last_name',
            'register_user',
        ];

        $factory = new RegisterFormFactory();

        /** @var RegisterForm $form */
        $form = $factory($container->reveal());

        $this->assertTrue($form instanceof RegisterForm);
        $this->assertEquals(
            $expectedElementKeys, array_keys($form->getElements())
        );
    }
}
