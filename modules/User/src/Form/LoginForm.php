<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Form;

use Zend\Form\Form;

/**
 * Class LoginForm
 *
 * @package User\Form
 */
class LoginForm extends Form
{
    /**
     * Add form elements
     *
     * @return void
     */
    public function init()
    {
        $this->setName('user_login_form');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(
            [
                'name'       => 'email',
                'type'       => 'text',
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
                'type'       => 'password',
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
                'name'       => 'login_user',
                'type'       => 'submit',
                'attributes' => [
                    'class' => 'btn btn-success',
                    'value' => 'user_action_login',
                    'id'    => 'login_user',
                ],
            ]
        );
    }

}