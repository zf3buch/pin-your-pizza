<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza;

use Zend\Config\Config;
use Zend\Config\Factory;

define('PIZZA_ROOT', __DIR__ . '/..');

/**
 * Class PizzaConfig
 *
 * @package Pizza
 */
class PizzaConfig
{
    /**
     * Read configuration
     *
     * @return array|Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            PIZZA_ROOT . '/config/module.config.php'
        );
    }
}