<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'middleware_pipeline' => [
        'pre_routing' => [
            [
                'middleware' => [
                    I18n\Middleware\CheckLanguage::class,
                    Zend\Expressive\Helper\ServerUrlMiddleware::class,
                    Zend\Expressive\Helper\UrlHelperMiddleware::class,
                    I18n\Middleware\InjectTranslator::class,
                    User\Authorization\AuthorizationMiddleware::class,
                ],
            ],
        ],

        'post_routing' => [
        ],
    ],
];
