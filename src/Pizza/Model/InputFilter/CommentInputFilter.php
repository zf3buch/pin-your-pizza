<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\InputFilter;

use Zend\InputFilter\InputFilter;

/**
 * Class CommentInputFilter
 *
 * @package Pizza\Model\InputFilter
 */
class CommentInputFilter extends InputFilter
{
    /**
     * Init input filter
     */
    public function init()
    {
        $this->add(
            [
                'name'       => 'name',
                'required'   => true,
                'filters'    => [
                    [
                        'name' => 'StripTags',
                    ],
                    [
                        'name' => 'StringTrim',
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'Bitte Namen eingeben!',
                        ],
                    ],
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min'      => 3,
                            'max'      => 64,
                            'message'  => 'Nur %min%-%max% Zeichen erlaubt!',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'text',
                'required'   => true,
                'filters'    => [
                    [
                        'name' => 'StripTags',
                    ],
                    [
                        'name' => 'StringTrim',
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'Bitte Kommentar eingeben!',
                        ],
                    ],
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min'      => 3,
                            'message'  => 'Mindestens %min% Zeichen eingeben!',
                        ],
                    ],
                ],
            ]
        );
    }
}
