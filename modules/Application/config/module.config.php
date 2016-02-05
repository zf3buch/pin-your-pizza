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
            Application\Action\HomePageAction::class =>
                Application\Action\HomePageFactory::class,
            
            Zend\Db\Adapter\AdapterInterface::class =>
                Zend\Db\Adapter\AdapterServiceFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/:lang',
            'middleware' => Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
    ],

    'templates' => [
        'layout' => 'layout/default',
        'map'    => [
            'layout/default' => APPLICATION_ROOT
                . '/templates/layout/default.phtml',
            'error/error'    => APPLICATION_ROOT
                . '/templates/error/error.phtml',
            'error/404'      => APPLICATION_ROOT
                . '/templates/error/404.phtml',
        ],
        'paths'  => [
            'application' => [APPLICATION_ROOT . '/templates/application'],
            'layout'      => [APPLICATION_ROOT . '/templates/layout'],
            'error'       => [APPLICATION_ROOT . '/templates/error'],
        ],
    ],

    'view_helpers' => [],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'         => 'phpArray',
                'base_dir'     => APPLICATION_ROOT . '/application',
                'pattern'      => '%s.php',
                'text_domain'  => 'default',
            ],
        ],
    ],
];
