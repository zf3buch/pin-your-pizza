<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'db' => [
        'driver' => 'pdo',
        'dsn'    => 'mysql:dbname=vote-my-pizza-test;host=localhost;charset=utf8',
        'user'   => 'vote-my-pizza',
        'pass'   => 'geheim',
    ],
];
