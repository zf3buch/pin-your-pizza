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
use User\Model\InputFilter\RegisterInputFilter;
use User\Model\InputFilter\RegisterInputFilterFactory;

/**
 * Class RegisterInputFilterFactoryTest
 *
 * @package UserTest\Model\InputFilter
 */
class RegisterInputFilterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter factory
     */
    public function testFactory()
    {
        $container = $this->prophesize(ContainerInterface::class);

        $expectedInputKeys = [
            'email',
            'password',
            'first_name',
            'last_name',
        ];

        $factory = new RegisterInputFilterFactory();

        /** @var RegisterInputFilter $inputFilter */
        $inputFilter = $factory($container->reveal());

        $this->assertTrue($inputFilter instanceof RegisterInputFilter);
        $this->assertEquals(
            $expectedInputKeys, array_keys($inputFilter->getInputs())
        );
    }
}
