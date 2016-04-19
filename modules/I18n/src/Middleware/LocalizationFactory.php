<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n\Middleware;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;

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
        $translator = $container->get(Translator::class);
        $config     = $container->get('config')['i18n'];

        $middleware = new LocalizationMiddleware($translator);
        $middleware->setDefaultLang($config['defaultLang']);
        $middleware->setAllowedLocales($config['allowedLocales']);

        return $middleware;
    }
}
