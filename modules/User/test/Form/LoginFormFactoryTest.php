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
use User\Form\LoginFormFactory;
use User\Form\LoginForm;
use User\Model\InputFilter\LoginInputFilter;
use Prophecy\Prophecy\MethodProphecy;

/**
 * Class LoginFormFactoryTest
 *
 * @package UserTest\Form
 */
class LoginFormFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        $container = $this->prophesize(ContainerInterface::class);

        /** @var LoginInputFilter $inputFilter */
        $inputFilter = $this->prophesize(LoginInputFilter::class);

        /** @var MethodProphecy $method */
        $method = $container->get(LoginInputFilter::class);
        $method->willReturn($inputFilter);
        $method->shouldBeCalled();

        $expectedElementKeys = ['email', 'password', 'login_user'];

        $factory = new LoginFormFactory();

        $this->assertTrue(
            $factory instanceof LoginFormFactory
        );

        /** @var LoginForm $form */
        $form = $factory($container->reveal());

        $this->assertTrue($form instanceof LoginForm);
        $this->assertEquals(
            $expectedElementKeys, array_keys($form->getElements())
        );
    }
}
