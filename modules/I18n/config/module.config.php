<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'dependencies' => [
        'invokables' => [
            I18n\Middleware\CheckRootUriMiddleware::class =>
                I18n\Middleware\CheckRootUriMiddleware::class,
        ],

        'factories' => [
            I18n\Middleware\LocalizationMiddleware::class =>
                I18n\Middleware\LocalizationFactory::class,
        ],
    ],
];
