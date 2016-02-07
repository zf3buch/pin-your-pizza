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
            Zend\Db\Adapter\AdapterInterface::class =>
                Zend\Db\Adapter\AdapterServiceFactory::class,

            Zend\Session\Config\SessionConfig::class =>
                Zend\Session\Service\SessionConfigFactory::class,

            Application\View\Model\LayoutModel::class =>
                Application\View\Model\LayoutFactory::class,
        ],
    ],

    'templates' => [
        'layout' => 'layout/default',
        'layout_segments' => [
            'layout/header',
            'layout/footer',
        ],
        'map'    => [
            'layout/default' => APPLICATION_ROOT
                . '/templates/layout/default.phtml',
            'layout/header'  => APPLICATION_ROOT
                . '/templates/layout/header.phtml',
            'layout/footer'  => APPLICATION_ROOT
                . '/templates/layout/footer.phtml',
            'error/error'    => APPLICATION_ROOT
                . '/templates/error/error.phtml',
            'error/404'      => APPLICATION_ROOT
                . '/templates/error/404.phtml',
        ],
        'paths'  => [
            'layout'      => [APPLICATION_ROOT . '/templates/layout'],
            'error'       => [APPLICATION_ROOT . '/templates/error'],
        ],
    ],

    'view_helpers' => [],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'         => 'phpArray',
                'base_dir'     => APPLICATION_ROOT . '/language',
                'pattern'      => '%s.php',
                'text_domain'  => 'default',
            ],
        ],
    ],

    'session_config' => [
        'save_path'       => realpath(PROJECT_ROOT . '/data/session'),
        'name'            => 'MY_SESSION',
        'cookie_lifetime' => 365 * 24 * 60 * 60,
        'gc_maxlifetime'  => 720,
    ],
];
