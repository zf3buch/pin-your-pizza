<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Form;

use PHPUnit_Framework_TestCase;
use User\Form\RegisterForm;

/**
 * Class RegisterFormTest
 *
 * @package UserTest\Form
 */
class RegisterFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if expected elements exits
     */
    public function testElementsExistence()
    {
        $expectedElements = [
            'email'         => [
                'type'  => 'text',
                'name'  => 'email',
                'label' => 'user_label_email',
                'value' => null,
            ],
            'password'      => [
                'type'  => 'password',
                'name'  => 'password',
                'label' => 'user_label_password',
                'value' => null,
            ],
            'first_name'    => [
                'type'  => 'text',
                'name'  => 'first_name',
                'label' => 'user_label_first_name',
                'value' => null,
            ],
            'last_name'     => [
                'type'  => 'text',
                'name'  => 'last_name',
                'label' => 'user_label_last_name',
                'value' => null,
            ],
            'register_user' => [
                'type'  => 'submit',
                'name'  => 'register_user',
                'label' => null,
                'value' => 'user_action_register',
            ],
        ];

        $form = new RegisterForm();
        $form->init();

        foreach ($expectedElements as $elementName => $elementData) {
            $element = $form->get($elementName);

            $this->assertEquals(
                $elementData['type'], $element->getAttribute('type')
            );
            $this->assertEquals(
                $elementData['name'], $element->getAttribute('name')
            );
            $this->assertEquals(
                $elementData['label'], $element->getLabel()
            );
            $this->assertEquals(
                $elementData['value'], $element->getValue()
            );
        }
    }

    /**
     * Test element values
     */
    public function testElementsValues()
    {
        $elementValues = [
            'email'      => 'test@test.de',
            'password'   => 'Test1234',
            'first_name' => 'Theo',
            'last_name'  => 'Tester',
        ];

        $form = new RegisterForm();
        $form->init();
        $form->setData($elementValues);

        foreach ($elementValues as $elementName => $elementValue) {
            $this->assertEquals(
                $elementValue, $form->get($elementName)->getValue()
            );
        }
    }
}
