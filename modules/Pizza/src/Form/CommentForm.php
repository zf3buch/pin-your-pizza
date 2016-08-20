<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Form;

use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

/**
 * Class CommentPriceForm
 *
 * @package Pizza\Form
 */
class CommentForm extends Form
{
    /**
     * Add form elements
     *
     * @return void
     */
    public function init()
    {
        $this->setName('comment_form');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(
            [
                'name'       => 'name',
                'type'       => Text::class,
                'options'    => [
                    'label'            => 'Ihr Name',
                    'label_attributes' => [
                        'class' => 'col-sm-4 control-label',
                    ],
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'text',
                'type'       => Textarea::class,
                'options'    => [
                    'label'            => 'Ihr Kommentar',
                    'label_attributes' => [
                        'class' => 'col-sm-4 control-label',
                    ],
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'save_comment',
                'type'       => Submit::class,
                'attributes' => [
                    'class' => 'btn btn-success',
                    'value' => 'Neuen Kommentar speichern',
                    'id'    => 'save_comment',
                ],
            ]
        );
    }

}