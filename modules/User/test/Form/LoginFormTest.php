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
use User\Form\LoginForm;

/**
 * Class LoginFormTest
 *
 * @package UserTest\Form
 */
class LoginFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if expected elements exits
     */
    public function testElementsExistence()
    {
        $expectedElements = [
            'email'       => [
                'type'  => 'email',
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
            'login_user' => [
                'type'  => 'submit',
                'name'  => 'login_user',
                'label' => null,
                'value' => 'user_action_login',
            ],
        ];

        $form = new LoginForm();
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
            'email'    => 'test@test.de',
            'password' => 'Test1234',
        ];

        $form = new LoginForm();
        $form->init();
        $form->setData($elementValues);

        foreach ($elementValues as $elementName => $elementValue) {
            $this->assertEquals(
                $elementValue, $form->get($elementName)->getValue()
            );
        }
    }
}
