<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Model\InputFilter;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use User\Model\InputFilter\LoginInputFilter;
use User\Model\InputFilter\LoginInputFilterFactory;

/**
 * Class LoginInputFilterFactoryTest
 *
 * @package UserTest\Model\InputFilter
 */
class LoginInputFilterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        $container = $this->prophesize(ContainerInterface::class);

        $expectedInputKeys = ['email', 'password'];

        $factory = new LoginInputFilterFactory();

        $this->assertTrue(
            $factory instanceof LoginInputFilterFactory
        );

        /** @var LoginInputFilter $inputFilter */
        $inputFilter = $factory($container->reveal());

        $this->assertTrue($inputFilter instanceof LoginInputFilter);
        $this->assertEquals(
            $expectedInputKeys, array_keys($inputFilter->getInputs())
        );
    }
}
