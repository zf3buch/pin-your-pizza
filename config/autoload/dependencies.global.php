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
            Zend\Expressive\Router\RouterInterface::class =>
                Zend\Expressive\Router\ZendRouter::class,

            Zend\Expressive\Helper\ServerUrlHelper::class =>
                Zend\Expressive\Helper\ServerUrlHelper::class,
        ],

        'factories' => [
            Zend\Expressive\Application::class =>
                Zend\Expressive\Container\ApplicationFactory::class,

            'Zend\Expressive\FinalHandler' =>
                Zend\Expressive\Container\TemplatedErrorHandlerFactory::class,

            Zend\Expressive\Template\TemplateRendererInterface::class =>
                Zend\Expressive\ZendView\ZendViewRendererFactory::class,

            Zend\View\HelperPluginManager::class =>
                Zend\Expressive\ZendView\HelperPluginManagerFactory::class,

            Zend\Expressive\Helper\UrlHelper::class =>
                Zend\Expressive\Helper\UrlHelperFactory::class,

            Zend\Expressive\Helper\ServerUrlMiddleware::class =>
                Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class,

            Zend\Expressive\Helper\UrlHelperMiddleware::class =>
                Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class,
        ],
    ],
];
