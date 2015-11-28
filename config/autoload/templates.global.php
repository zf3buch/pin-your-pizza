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
            'Zend\Expressive\FinalHandler' =>
                Zend\Expressive\Container\TemplatedErrorHandlerFactory::class,

            Zend\Expressive\Template\TemplateRendererInterface::class =>
                Zend\Expressive\ZendView\ZendViewRendererFactory::class,
        ],
    ],

    'templates' => [
        'layout' => 'layout/default',
        'map'    => [
            'layout/default' => 'modules/Application/templates/layout/default.phtml',
            'error/error'    => 'modules/Application/templates/error/error.phtml',
            'error/404'      => 'modules/Application/templates/error/404.phtml',
        ],
        'paths'  => [
            'application' => ['modules/Application/templates/application'],
            'layout'      => ['modules/Application/templates/layout'],
            'error'       => ['modules/Application/templates/error'],
        ]
    ]
];
