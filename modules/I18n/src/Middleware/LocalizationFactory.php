<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n\Middleware;

use Interop\Container\ContainerInterface;

/**
 * Class LocalizationFactory
 *
 * @package I18n\Middleware
 */
class LocalizationFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return LocalizationMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['i18n'];

        $middleware = new LocalizationMiddleware();
        $middleware->setDefaultLang($config['defaultLang']);
        $middleware->setAllowedLocales($config['allowedLocales']);

        return $middleware;
    }
}
