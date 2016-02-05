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

            Pizza\Model\Repository\PizzaRepositoryInterface::class =>
                Pizza\Model\Repository\StaticPizzaRepositoryFactory::class,
            Pizza\Model\Repository\CommentRepositoryInterface::class =>
                Pizza\Model\Repository\StaticCommentRepositoryFactory::class,
        ]
    ],

    'routes' => [
        [
            'name'            => 'pizza-pinboard',
            'path'            => '/pizza',
            'middleware'      => Pizza\Action\ShowPinboardAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'pizza-show',
            'path'            => '/pizza/:id',
            'middleware'      => Pizza\Action\ShowPizzaAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id' => '[1-9][0-9]*',
                ],
            ],
        ],
        [
            'name'            => 'pizza-vote',
            'path'            => '/pizza/:id/vote',
            'middleware'      => Pizza\Action\HandleVoteAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id'   => '[1-9][0-9]*',
                    'star' => '[1-5]{1}',
                ],
            ],
        ],
        [
            'name'            => 'pizza-comment',
            'path'            => '/pizza/:id/comment',
            'middleware'      => Pizza\Action\HandleCommentAction::class,
            'allowed_methods' => ['GET'],
            'options'         => [
                'constraints' => [
                    'id' => '[1-9][0-9]*',
                ],
            ],
        ],
    ],

    'templates' => [
        'paths'  => [
            'pizza' => [PIZZA_ROOT . '/templates/pizza'],
        ]
    ],
];