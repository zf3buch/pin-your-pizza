<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'templates' => [
        'paths' => [
            'bootstrap' => [BOOTSTRAP_ROOT . '/templates/bootstrap'],
        ],
    ],

    'view_helpers' => [
        'invokables' => [
            'bootstrapForm' => Bootstrap\View\Helper\Form::class,
        ],
    ],
];
