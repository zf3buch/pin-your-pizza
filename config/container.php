<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use Zend\ServiceManager\ServiceManager;
use Zend\Session\Config\SessionConfig;

$config = require PROJECT_ROOT . '/config/config.php';

$container = new ServiceManager($config['dependencies']);
$container->setService('config', $config);
$container->get(SessionConfig::class);

return $container;
