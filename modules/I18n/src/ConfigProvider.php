<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n;

use Zend\Config\Config;
use Zend\Config\Factory;

define('I18N_ROOT', __DIR__ . '/..');

/**
 * Class ConfigProvider
 *
 * @package I18n
 */
class ConfigProvider
{
    /**
     * Read configuration
     *
     * @return array|Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            I18N_ROOT . '/config/module.config.php'
        );
    }
}