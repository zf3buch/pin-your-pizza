<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    1 => [
        'id'       => '1',
        'name'     => 'Pizza Mista',
        'image'    => '/assets/custom/pizza/001.jpg',
        'rate'     => 4.5,
        'comments' => [
            1 => [
                'date' => mktime(
                    15, 12, 56, date('m') - 1, date('d') - 6, date('Y')
                ),
                'name' => 'Peter',
                'text' => '<p>Sehr lecker!</p>',
            ],
            2 => [
                'date' => mktime(
                    18, 2, 14, date('m'), date('d') - 16, date('Y')
                ),
                'name' => 'Paul',
                'text' => '<p>Beste Pizza!</p>',
            ],
        ],
    ],
    2 => [
        'id'       => '2',
        'name'     => 'Pizza Oliva',
        'image'    => '/assets/custom/pizza/002.jpg',
        'rate'     => 5.0,
        'comments' => [
            3 => [
                'date' => mktime(
                    12, 37, 5, date('m') - 2, date('d') - 11, date('Y')
                ),
                'name' => 'Luigi',
                'text' => '<p>Könnte meine Mamma nicht besser machen!</p>',
            ],
        ],
    ],
    3 => [
        'id'       => '3',
        'name'     => 'Pizza Margherita',
        'image'    => '/assets/custom/pizza/003.jpg',
        'rate'     => 2.0,
        'comments' => [
            4 => [
                'date' => mktime(
                    11, 9, 2, date('m'), date('d') - 17, date('Y')
                ),
                'name' => 'Heinzelmann',
                'text' => '<p>Irgendwie langweilig.</p>',
            ],
        ],
    ],
    4 => [
        'id'       => '4',
        'name'     => 'Pizza Gambero',
        'image'    => '/assets/custom/pizza/004.jpg',
        'rate'     => 1.5,
        'comments' => [
            5 => [
                'date' => mktime(
                    4, 42, 49, date('m') - 3, date('d') - 19, date('Y')
                ),
                'name' => 'Heinzelmann',
                'text' => '<p>Toter Fisch hat auf Pizza nichts zu suchen!</p>',
            ],
        ],
    ],
    5 => [
        'id'       => '5',
        'name'     => 'Pizza Verdura',
        'image'    => '/assets/custom/pizza/005.jpg',
        'rate'     => 2.5,
        'comments' => [
            6 => [
                'date' => mktime(
                    12, 0, 17, date('m') - 2, date('d') - 1, date('Y')
                ),
                'name' => 'Heinzelmann',
                'text' => '<p>Geht so!</p>',
            ],
        ],
    ],
    6 => [
        'id'       => '6',
        'name'     => 'Pizza Peperone',
        'image'    => '/assets/custom/pizza/006.jpg',
        'rate'     => 3.0,
        'comments' => [
            7  => [
                'date' => mktime(
                    18, 18, 19, date('m') - 3, date('d') - 12, date('Y')
                ),
                'name' => 'Heinzelmann',
                'text' => '<p>Da sind ja gar keine Peperoni darauf!</p>',
            ],
            8  => [
                'date' => mktime(
                    2, 8, 57, date('m') - 3, date('d') - 9, date('Y')
                ),
                'name' => 'Luigi',
                'text' => '<p>Da steht ja auch Peperone und nicht Peperoni!</p>',
            ],
            9  => [
                'date' => mktime(
                    15, 47, 1, date('m') - 2, date('d') - 27, date('Y')
                ),
                'name' => 'Heinzelmann',
                'text' => '<p>Witzbold! Als wenn da ein Unterschied wäre...</p>',
            ],
            10 => [
                'date' => mktime(
                    12, 1, 59, date('m') - 1, date('d') - 12, date('Y')
                ),
                'name' => 'Luigi',
                'text' => '<p>Peperone heißt nun mal Paprika, du Schlaumeier!</p>',
            ],
        ],
    ],
    7 => [
        'id'       => '7',
        'name'     => 'Pizza Vegetariana',
        'image'    => '/assets/custom/pizza/007.jpg',
        'rate'     => 2.0,
        'comments' => [],
    ],
    8 => [
        'id'       => '8',
        'name'     => 'Pizza Salame',
        'image'    => '/assets/custom/pizza/008.jpg',
        'rate'     => 5.0,
        'comments' => [
            11 => [
                'date' => mktime(
                    1, 3, 59, date('m'), date('d') - 1, date('Y')
                ),
                'name' => 'Peter',
                'text' => '<p>Es gibt kaum etwas besseres...</p>',
            ],
        ],
    ],
    9 => [
        'id'       => '9',
        'name'     => 'Pizza Funghi e Oliva',
        'image'    => '/assets/custom/pizza/009.jpg',
        'rate'     => 2.5,
        'comments' => [],
    ],
];