<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\InputFilter;

use Zend\InputFilter\InputFilter;

/**
 * Class LoginInputFilter
 *
 * @package User\Model\InputFilter
 */
class LoginInputFilter extends InputFilter
{
    /**
     * Init input filter
     */
    public function init()
    {
        $this->add(
            [
                'name'       => 'email',
                'required'   => true,
                'filters'    => [
                    [
                        'name' => 'StringTrim',
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'user_validator_email_notempty',
                        ],
                    ],
                    [
                        'name'    => 'EmailAddress',
                        'options' => [
                            'message' => 'user_validator_email_format',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'password',
                'required'   => true,
                'filters'    => [],
                'validators' => [
                    [
                        'name'                   => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'user_validator_password_notempty',
                        ],
                    ],
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 64,
                            'message'  => 'user_validator_password_length',
                        ],
                    ],
                ],
            ]
        );
    }
}
