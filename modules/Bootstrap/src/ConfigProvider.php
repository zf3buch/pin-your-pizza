<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Bootstrap;

use Zend\Config\Factory;

/**
 * Class ConfigProvider
 *
 * @package Bootstrap
 */
class ConfigProvider
{
    /**
     * Define constant
     */
    public function __construct()
    {
        define('BOOTSTRAP_ROOT', __DIR__ . '/..');
    }

    /**
     * Read configuration
     *
     * @return array|\Zend\Config\Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            BOOTSTRAP_ROOT . '/config/bootstrap.config.php'
        );
    }
}
