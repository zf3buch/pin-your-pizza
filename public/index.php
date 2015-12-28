<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use Interop\Container\ContainerInterface;

// define application root for better file path definitions
define('PROJECT_ROOT', realpath(__DIR__ . '/..'));

// define application environment, needs to be set within virtual host
// but could be chosen by any other identifier
define(
'APPLICATION_ENV', (getenv('APPLICATION_ENV')
    ? getenv('APPLICATION_ENV')
    : 'production')
);

// Delegate static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

// setup autoloading from composer
require_once PROJECT_ROOT . '/vendor/autoload.php';

// change working dir
chdir(dirname(__DIR__));

/** @var ContainerInterface $container */
$container = require PROJECT_ROOT . '/config/container.php';

// run the application
$app = $container->get('Zend\Expressive\Application')->run();
