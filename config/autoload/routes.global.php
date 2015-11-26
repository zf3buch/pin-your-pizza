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
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'show-pizza',
            'path' => '/pizza/:id',
            'middleware' => Pizza\Action\ShowPizzaAction::class,
            'allowed_methods' => ['GET'],
            'options' => [
                'constraints' => [
                    'id' => '[0-9]+',
                ],
            ],
        ],
        [
            'name' => 'vote-pizza',
            'path' => '/pizza/:id/vote',
            'middleware' => Pizza\Action\HandleVoteAction::class,
            'allowed_methods' => ['GET'],
            'options' => [
                'constraints' => [
                    'id' => '[0-9]+',
                ],
            ],
        ],
        [
            'name' => 'comment-pizza',
            'path' => '/pizza/:id/comment',
            'middleware' => Pizza\Action\HandleCommentAction::class,
            'allowed_methods' => ['GET'],
            'options' => [
                'constraints' => [
                    'id' => '[0-9]+',
                ],
            ],
        ],
    ],
];
