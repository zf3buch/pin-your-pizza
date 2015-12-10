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
            Pizza\Action\ShowPinboardAction::class =>
                Pizza\Action\ShowPinboardFactory::class,
            Pizza\Action\ShowPizzaAction::class    =>
                Pizza\Action\ShowPizzaFactory::class,
            Pizza\Action\HandleVoteAction::class =>
                Pizza\Action\HandleVoteFactory::class,

            Pizza\Model\Service\PizzaServiceInterface::class =>
                Pizza\Model\Service\StaticPizzaServiceFactory::class,
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
    ],

    'templates' => [
        'paths' => [
            'pizza' => ['templates/pizza'],
        ]
    ],
];
