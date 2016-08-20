<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Form;

use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class RegisterForm
 *
 * @package User\Form
 */
class RegisterForm extends Form
{
    /**
     * Add form elements
     *
     * @return void
     */
    public function init()
    {
        $this->setName('user_register_form');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(
            [
                'name'       => 'email',
                'type'       => Email::class,
                'options'    => [
                    'label'            => 'user_label_email',
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
                'name'       => 'password',
                'type'       => Password::class,
                'options'    => [
                    'label'            => 'user_label_password',
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
                'name'       => 'first_name',
                'type'       => Text::class,
                'options'    => [
                    'label'            => 'user_label_first_name',
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
                'name'       => 'last_name',
                'type'       => Text::class,
                'options'    => [
                    'label'            => 'user_label_last_name',
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
                'name'       => 'register_user',
                'type'       => Submit::class,
                'attributes' => [
                    'class' => 'btn btn-success',
                    'value' => 'user_action_register',
                    'id'    => 'register_user',
                ],
            ]
        );
    }

}