<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'db' => [
        'driver' => 'pdo',
        'dsn'    => 'mysql:dbname=pin-your-pizza-test;host=localhost;charset=utf8',
        'user'   => 'pin-your-pizza',
        'pass'   => 'geheim',
    ],
];