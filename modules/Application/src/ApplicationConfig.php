<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application;

use Zend\Config\Factory;

/**
 * Class ApplicationConfig
 *
 * @package Application
 */
class ApplicationConfig
{
    /**
     * Define constant
     */
    public function __construct()
    {
        define('APPLICATION_ROOT', __DIR__ . '/..');
    }

    /**
     * Read configuration
     *
     * @return array|\Zend\Config\Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            APPLICATION_ROOT . '/config/application.config.php'
        );
    }
}
