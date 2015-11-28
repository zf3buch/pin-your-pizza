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
            Pizza\Action\HomePageAction::class =>
                Pizza\Action\HomePageFactory::class,

            Pizza\Action\ShowPizzaAction::class =>
                Pizza\Action\ShowPizzaFactory::class,
            Pizza\Action\HandleVoteAction::class =>
                Pizza\Action\HandleVoteFactory::class,

            Pizza\Model\Service\PizzaServiceInterface::class =>
                Pizza\Model\Service\StaticPizzaServiceFactory::class,
        ]
    ],

    'routes' => [
        [
            'name'            => 'home',
            'path'            => '/',
            'middleware'      => Pizza\Action\HomePageAction::class,
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
    ],

    'templates' => [
        'paths'  => [
            'pizza' => ['modules/Pizza/templates/'],
        ]
    ],
];
