<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\InputFilter;

use PHPUnit_Framework_TestCase;
use Pizza\Model\InputFilter\CommentInputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * Class CommentInputFilterTest
 *
 * @package PizzaTest\Model\InputFilter
 */
class CommentInputFilterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Do the input filter test
     *
     * @param $inputData
     * @param $expectedResult
     * @param $expectedValues
     * @param $expectedMessages
     */
    protected function doInputFilterTest(
        $inputData, $expectedResult, $expectedValues, $expectedMessages
    ) {
        $inputFilter = new CommentInputFilter();
        $inputFilter->init();

        $inputFilter->setData($inputData);

        $result = $inputFilter->isValid();

        $this->assertEquals($expectedResult, $result);
        $this->assertEquals($expectedValues, $inputFilter->getValues());
        $this->assertEquals(
            $expectedMessages, $inputFilter->getMessages()
        );
    }

    /**
     * Test input filter with empty data
     */
    public function testWithEmptyData()
    {
        $inputData        = [];
        $expectedValues   = [
            'name' => null,
            'text' => null,
        ];
        $expectedMessages = [
            'name' => [
                NotEmpty::IS_EMPTY => 'pizza_validator_name_notempty',
            ],
            'text' => [
                NotEmpty::IS_EMPTY => 'pizza_validator_comment_notempty',
            ],
        ];
        $expectedResult   = false;

        $this->doInputFilterTest(
            $inputData, $expectedResult, $expectedValues, $expectedMessages
        );
    }

    /**
     * Test input filter with empty values
     */
    public function testWithEmptyValues()
    {
        $inputData        = [
            'name' => null,
            'text' => null,
        ];
        $expectedValues   = [
            'name' => null,
            'text' => null,
        ];
        $expectedMessages = [
            'name' => [
                NotEmpty::IS_EMPTY => 'pizza_validator_name_notempty',
            ],
            'text' => [
                NotEmpty::IS_EMPTY => 'pizza_validator_comment_notempty',
            ],
        ];
        $expectedResult   = false;

        $this->doInputFilterTest(
            $inputData, $expectedResult, $expectedValues, $expectedMessages
        );
    }

    /**
     * Test input filter with invalid values
     */
    public function testWithInvalidValues()
    {
        $inputData        = [
            'name' => '2',
            'text' => '3',
        ];
        $expectedValues   = [
            'name' => '2',
            'text' => '3',
        ];
        $expectedMessages = [
            'name' => [
                StringLength::TOO_SHORT => 'pizza_validator_name_length',
            ],
            'text' => [
                StringLength::TOO_SHORT => 'pizza_validator_comment_length',
            ],
        ];
        $expectedResult   = false;

        $this->doInputFilterTest(
            $inputData, $expectedResult, $expectedValues, $expectedMessages
        );
    }

    /**
     * Test input filter with valid values
     */
    public function testWithValidValues()
    {
        $inputData        = [
            'name' => 'Test',
            'text' => 'Text',
        ];
        $expectedValues   = [
            'name' => 'Test',
            'text' => 'Text',
        ];
        $expectedMessages = [];
        $expectedResult   = true;

        $this->doInputFilterTest(
            $inputData, $expectedResult, $expectedValues, $expectedMessages
        );
    }

    /**
     * Test input filter with filtered values
     */
    public function testWithFilteredValues()
    {
        $inputData        = [
            'name' => ' Test <b>Name</b> ',
            'text' => '2.99',
        ];
        $expectedValues   = [
            'name' => 'Test Name',
            'text' => 2.99,
        ];
        $expectedMessages = [];
        $expectedResult   = true;

        $this->doInputFilterTest(
            $inputData, $expectedResult, $expectedValues, $expectedMessages
        );
    }
}
