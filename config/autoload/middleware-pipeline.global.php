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
        'factories' => [
            Zend\Expressive\Helper\ServerUrlMiddleware::class =>
                Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class,
            Zend\Expressive\Helper\UrlHelperMiddleware::class =>
                Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class,
        ],
    ],

    'middleware_pipeline' => [
        'always' => [
            'middleware' => [
                Zend\Expressive\Helper\ServerUrlMiddleware::class,
                I18n\Middleware\CheckRootUriMiddleware::class,
            ],
            'priority'   => 10000,
        ],

        'routing' => [
            'middleware' => [
                Zend\Expressive\Container\ApplicationFactory::ROUTING_MIDDLEWARE,
                Zend\Expressive\Helper\UrlHelperMiddleware::class,
                I18n\Middleware\LocalizationMiddleware::class,
                I18n\Middleware\InjectTranslatorMiddleware::class,
                User\Authorization\AuthorizationMiddleware::class,
                Zend\Expressive\Container\ApplicationFactory::DISPATCH_MIDDLEWARE,
            ],
            'priority'   => 1,
        ],

        'error' => [
            'middleware' => [
                // Add error middleware here.
            ],
            'error'      => true,
            'priority'   => -10000,
        ],
    ],
];
