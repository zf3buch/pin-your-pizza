<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application;

use Zend\Config\Config;
use Zend\Config\Factory;

define('APPLICATION_ROOT', __DIR__ . '/..');

/**
 * Class ApplicationConfig
 *
 * @package Application
 */
class ApplicationConfig
{
    /**
     * Read configuration
     *
     * @return array|Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            APPLICATION_ROOT . '/config/module.config.php'
        );
    }
}