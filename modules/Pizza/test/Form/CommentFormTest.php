<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Form;

use PHPUnit_Framework_TestCase;
use Pizza\Form\CommentForm;

/**
 * Class CommentFormTest
 *
 * @package PizzaTest\Form
 */
class CommentFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if expected elements exits
     */
    public function testElementsExistence()
    {
        $expectedElements = [
            'name'         => [
                'type'  => 'text',
                'name'  => 'name',
                'label' => 'pizza_label_name',
                'value' => null,
            ],
            'text'         => [
                'type'  => 'textarea',
                'name'  => 'text',
                'label' => 'pizza_label_comment',
                'value' => null,
            ],
            'save_comment' => [
                'type'  => 'submit',
                'name'  => 'save_comment',
                'label' => null,
                'value' => 'pizza_action_new_comment',
            ],
        ];

        $form = new CommentForm();
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
            'name' => 'Test name',
            'text' => 'Test comment',
        ];

        $form = new CommentForm();
        $form->init();
        $form->setData($elementValues);

        foreach ($elementValues as $elementName => $elementValue) {
            $this->assertEquals(
                $elementValue, $form->get($elementName)->getValue()
            );
        }
    }
}
