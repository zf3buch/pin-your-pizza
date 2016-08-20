<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

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
                        'name' => StripTags::class,
                    ],
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'pizza_validator_name_notempty',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'min'      => 3,
                            'max'      => 64,
                            'message'  => 'pizza_validator_name_length',
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
                        'name' => StripTags::class,
                    ],
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'pizza_validator_comment_notempty',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'min'      => 3,
                            'message'  => 'pizza_validator_comment_length',
                        ],
                    ],
                ],
            ]
        );
    }
}
