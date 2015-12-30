<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n;

use Zend\Config\Factory;

/**
 * Class I18nConfig
 *
 * @package I18n
 */
class I18nConfig
{
    /**
     * Define constant
     */
    public function __construct()
    {
        define('I18N_ROOT', __DIR__ . '/..');
    }

    /**
     * Read configuration
     *
     * @return array|\Zend\Config\Config
     */
    public function __invoke()
    {
        return Factory::fromFile(
            I18N_ROOT . '/config/i18n.config.php'
        );
    }
}
