<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'dependencies' => [
        'factories' => [
            Zend\Db\Adapter\AdapterInterface::class =>
                Zend\Db\Adapter\AdapterServiceFactory::class,
        ],
    ],

    'db' => [
        'driver'  => 'pdo',
        'dsn'     => 'mysql:dbname=DATABASE;host=localhost;charset=utf8',
        'user'    => 'USER',
        'pass'    => 'PASS',
    ],
];
