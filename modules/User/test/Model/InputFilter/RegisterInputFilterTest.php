<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Model\InputFilter;

use PHPUnit_Framework_TestCase;
use User\Model\InputFilter\RegisterInputFilter;
use Zend\I18n\Validator\IsFloat;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * Class RegisterInputFilterTest
 *
 * @package UserTest\Model\InputFilter
 */
class RegisterInputFilterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test input filter with empty data
     */
    public function testWithEmptyData()
    {
        $inputData        = [];
        $expectedValues   = [
            'email'      => null,
            'password'   => null,
            'first_name' => null,
            'last_name'  => null,
        ];
        $expectedMessages = [
            'email'      => [
                NotEmpty::IS_EMPTY => 'user_validator_email_notempty',
            ],
            'password'   => [
                NotEmpty::IS_EMPTY => 'user_validator_password_notempty',
            ],
            'first_name' => [
                NotEmpty::IS_EMPTY => 'user_validator_first_name_notempty',
            ],
            'last_name'  => [
                NotEmpty::IS_EMPTY => 'user_validator_last_name_notempty',
            ],
        ];

        $inputFilter = new RegisterInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertFalse($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with empty values
     */
    public function testWithEmptyValues()
    {
        $inputData        = [
            'email'      => null,
            'password'   => null,
            'first_name' => null,
            'last_name'  => null,
        ];
        $expectedValues   = [
            'email'      => null,
            'password'   => null,
            'first_name' => null,
            'last_name'  => null,
        ];
        $expectedMessages = [
            'email'      => [
                NotEmpty::IS_EMPTY => 'user_validator_email_notempty',
            ],
            'password'   => [
                NotEmpty::IS_EMPTY => 'user_validator_password_notempty',
            ],
            'first_name' => [
                NotEmpty::IS_EMPTY => 'user_validator_first_name_notempty',
            ],
            'last_name'  => [
                NotEmpty::IS_EMPTY => 'user_validator_last_name_notempty',
            ],
        ];

        $inputFilter = new RegisterInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertFalse($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with invalid values
     */
    public function testWithInvalidValues()
    {
        $inputData        = [
            'email'      => '2',
            'password'   => 'zwei',
            'first_name' => '2',
            'last_name'  => '2',
        ];
        $expectedValues   = [
            'email'      => '2',
            'password'   => 'zwei',
            'first_name' => '2',
            'last_name'  => '2',
        ];
        $expectedMessages = [
            'email'      => [
                EmailAddress::INVALID_FORMAT => 'user_validator_email_format',
            ],
            'password'   => [
                StringLength::TOO_SHORT => 'user_validator_password_length',
            ],
            'first_name' => [
                StringLength::TOO_SHORT => 'user_validator_first_name_length',
            ],
            'last_name'  => [
                StringLength::TOO_SHORT => 'user_validator_last_name_length',
            ],
        ];

        $inputFilter = new RegisterInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertFalse($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with valid values
     */
    public function testWithValidValues()
    {
        $inputData        = [
            'email'    => 'theo@tester.de',
            'password' => 'Test1234',
            'first_name' => 'Test',
            'last_name'  => 'Test',
        ];
        $expectedValues   = [
            'email'    => 'theo@tester.de',
            'password' => 'Test1234',
            'first_name' => 'Test',
            'last_name'  => 'Test',
        ];
        $expectedMessages = [];

        $inputFilter = new RegisterInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertTrue($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with filtered values
     */
    public function testWithFilteredValues()
    {
        $inputData        = [
            'email'    => ' theo@tester.de ',
            'password' => 'Test1234',
            'first_name' => ' Test Name ',
            'last_name'  => ' Test Name ',
        ];
        $expectedValues   = [
            'email'    => 'theo@tester.de',
            'password' => 'Test1234',
            'first_name' => 'Test Name',
            'last_name'  => 'Test Name',
        ];
        $expectedMessages = [];

        $inputFilter = new RegisterInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertTrue($result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }
}
