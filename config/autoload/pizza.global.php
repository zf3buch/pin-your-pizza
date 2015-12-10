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
            Pizza\Action\ShowIntroAction::class =>
                Pizza\Action\ShowIntroFactory::class,

            Pizza\Action\ShowPizzaAction::class =>
                Pizza\Action\ShowPizzaFactory::class,

            Pizza\Model\Service\PizzaServiceInterface::class =>
                Pizza\Model\Service\StaticPizzaServiceFactory::class,
        ]
    ],

    'routes' => [
        [
            'name'            => 'pizza-intro',
            'path'            => '/pizza',
            'middleware'      => Pizza\Action\ShowIntroAction::class,
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
    ],

    'templates' => [
        'paths'  => [
            'pizza' => ['templates/pizza'],
        ]
    ],
];
