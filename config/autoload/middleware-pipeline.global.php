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
            Application\I18n\Middleware\CheckLanguage::class =>
                Application\I18n\Middleware\CheckLanguage::class,
        ],
        'factories' => [
            Zend\Expressive\Helper\ServerUrlMiddleware::class =>
                Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class,
            Zend\Expressive\Helper\UrlHelperMiddleware::class =>
                Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class,
        ],
    ],

    'middleware_pipeline' => [
        'pre_routing' => [
            [
                'middleware' => [
                    Application\I18n\Middleware\CheckLanguage::class,
                    Zend\Expressive\Helper\ServerUrlMiddleware::class,
                    Zend\Expressive\Helper\UrlHelperMiddleware::class,
                ],
            ],
        ],

        'post_routing' => [
        ],
    ],
];
