<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\Exception\MissingRouterException;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class UrlHelperFactory
 *
 * @package I18n\View\Helper
 */
class UrlHelperFactory
{
    /**
     * Create a UrlHelper instance.
     *
     * @param ContainerInterface $container
     * @return UrlHelper
     */
    public function __invoke(ContainerInterface $container)
    {
        if (! $container->has(RouterInterface::class)) {
            throw new MissingRouterException(sprintf(
                '%s requires a %s implementation; none found in container',
                UrlHelper::class,
                RouterInterface::class
            ));
        }

        $config = $container->get('config')['i18n'];

        $helper = new UrlHelper($container->get(RouterInterface::class));
        $helper->setDefaultLang($config['defaultLang']);
        $helper->setDefaultRoute($config['defaultRoute']);

        return $helper;
    }

}