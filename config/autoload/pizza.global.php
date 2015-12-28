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
            Pizza\Action\ShowPinboardAction::class  =>
                Pizza\Action\ShowPinboardFactory::class,
            Pizza\Action\ShowPizzaAction::class     =>
                Pizza\Action\ShowPizzaFactory::class,
            Pizza\Action\HandleVoteAction::class    =>
                Pizza\Action\HandleVoteFactory::class,
            Pizza\Action\HandleCommentAction::class =>
                Pizza\Action\HandleCommentFactory::class,
            Pizza\Action\DeleteCommentAction::class =>
                Pizza\Action\DeleteCommentFactory::class,

            Pizza\Model\Table\PizzaTableInterface::class   =>
                Pizza\Model\Table\PizzaTableFactory::class,
            Pizza\Model\Table\CommentTableInterface::class =>
                Pizza\Model\Table\CommentTableFactory::class,

            Pizza\Model\Repository\PizzaRepositoryInterface::class =>
                Pizza\Model\Repository\PizzaRepositoryFactory::class,
            Pizza\Model\Repository\CommentRepositoryInterface::class =>
                Pizza\Model\Repository\CommentRepositoryFactory::class,

            Pizza\Model\InputFilter\CommentInputFilter::class =>
                Pizza\Model\InputFilter\CommentInputFilterFactory::class,

            Pizza\Form\CommentForm::class =>
                Pizza\Form\CommentFormFactory::class,
        ]
    ],

    'routes' => [
        [
            'name'            => 'pizza-pinboard',
            'path'            => '/:lang/pizza',
            'middleware'      => Pizza\Action\ShowPinboardAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-show',
            'path'            => '/:lang/pizza/:id',
            'middleware'      => Pizza\Action\ShowPizzaAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id'   => '[1-9][0-9]*',
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-vote',
            'path'            => '/:lang/pizza/:id/vote',
            'middleware'      => Pizza\Action\HandleVoteAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id'   => '[1-9][0-9]*',
                    'star' => '[1-5]{1}',
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-comment',
            'path'            => '/:lang/pizza/:id/comment',
            'middleware'      => [
                Pizza\Action\HandleCommentAction::class,
                Pizza\Action\ShowPizzaAction::class,
            ],
            'allowed_methods' => ['POST'],
            'options'         => [
                'constraints' => [
                    'id'   => '[1-9][0-9]*',
                    'lang' => '(de|en)',
                ],
            ],
        ],
        [
            'name'            => 'pizza-delete-comment',
            'path'            => '/:lang/pizza/:id/delete-comment/:commentId',
            'middleware'      => Pizza\Action\DeleteCommentAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id'      => '[1-9][0-9]*',
                    'commentId' => '[1-9][0-9]*',
                    'lang'    => '(de|en)',
                ],
            ],
        ],
    ],

    'templates' => [
        'paths' => [
            'pizza' => ['templates/pizza'],
        ]
    ],

    'translate' => [
        'translation_file_patterns' => [
            [
                'type'         => 'phpArray',
                'base_dir'     => APPLICATION_ROOT . '/language/pizza',
                'pattern'      => '%s.php',
                'text_domain'  => 'default',
            ],
        ],
    ],
];
