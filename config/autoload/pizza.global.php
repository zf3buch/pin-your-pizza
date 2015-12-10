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
    ],

    'templates' => [
        'paths'  => [
            'pizza' => ['templates/pizza'],
        ]
    ],
];
