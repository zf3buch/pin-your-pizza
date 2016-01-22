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
            Zend\I18n\Translator\Translator::class =>
                I18n\Translator\TranslatorFactory::class,

            I18n\Middleware\InjectTranslatorMiddleware::class =>
                I18n\Middleware\InjectTranslatorFactory::class,

            I18n\Middleware\LocalizationMiddleware::class =>
                I18n\Middleware\LocalizationFactory::class,
        ],
    ],

    'i18n' => [
        'defaultLang'    => 'de',
        'allowedLocales' => [
            'de' => 'de_DE',
            'en' => 'en_US',
        ],
        'defaultRoute'   => 'home',
    ],
];
