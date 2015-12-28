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
            User\Permissions\Rbac::class => User\Permissions\Rbac::class,
        ],

        'factories' => [
            User\Action\ShowIntroAction::class      =>
                User\Action\ShowIntroFactory::class,
            User\Action\HandleLoginAction::class    =>
                User\Action\HandleLoginFactory::class,
            User\Action\HandleRegisterAction::class =>
                User\Action\HandleRegisterFactory::class,
            User\Action\ShowRegisteredAction::class =>
                User\Action\ShowRegisteredFactory::class,
            User\Action\HandleLogoutAction::class   =>
                User\Action\HandleLogoutFactory::class,

            User\Model\Table\UserTableInterface::class =>
                User\Model\Table\UserTableFactory::class,

            User\Model\Repository\UserRepositoryInterface::class =>
                User\Model\Repository\DbUserRepositoryFactory::class,

            User\Model\InputFilter\LoginInputFilter::class    =>
                User\Model\InputFilter\LoginInputFilterFactory::class,
            User\Model\InputFilter\RegisterInputFilter::class =>
                User\Model\InputFilter\RegisterInputFilterFactory::class,

            User\Form\LoginForm::class    =>
                User\Form\LoginFormFactory::class,
            User\Form\RegisterForm::class =>
                User\Form\RegisterFormFactory::class,

            Zend\Authentication\Adapter\AdapterInterface::class       =>
                User\Authentication\Adapter\AdapterFactory::class,
            Zend\Authentication\AuthenticationServiceInterface::class =>
                User\Authentication\AuthenticationServiceFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'user-intro',
            'path'            => '/:lang/user',
            'middleware'      => User\Action\ShowIntroAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'user-handle-login',
            'path'            => '/:lang/user/login',
            'middleware'      => [
                User\Action\HandleLoginAction::class,
                User\Action\ShowIntroAction::class,
            ],
            'allowed_methods' => ['POST'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'user-handle-register',
            'path'            => '/:lang/user/register',
            'middleware'      => [
                User\Action\HandleRegisterAction::class,
                User\Action\ShowIntroAction::class,
            ],
            'allowed_methods' => ['POST'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'user-registered',
            'path'            => '/:lang/user/registered',
            'middleware'      => User\Action\ShowRegisteredAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'user-handle-logout',
            'path'            => '/:lang/user/logout',
            'middleware'      => User\Action\HandleLogoutAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
    ],

    'templates' => [
        'paths' => [
            'user' => ['templates/user'],
        ],
    ],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'        => 'phpArray',
                'base_dir'    => APPLICATION_ROOT . '/language/user',
                'pattern'     => '%s.php',
                'text_domain' => 'default',
            ],
        ],
    ],
];
