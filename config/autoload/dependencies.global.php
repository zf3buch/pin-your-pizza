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
            Zend\Expressive\Helper\ServerUrlHelper::class =>
                Zend\Expressive\Helper\ServerUrlHelper::class,
        ],

        'factories' => [
            Zend\Expressive\Application::class =>
                Application\Expressive\ApplicationFactory::class,
            Zend\Expressive\Helper\UrlHelper::class =>
                Application\View\Helper\UrlHelperFactory::class,
            Application\I18n\Observer\SetLanguageObserver::class =>
                Application\I18n\Observer\SetLanguageObserverFactory::class,
        ]
    ]
];
