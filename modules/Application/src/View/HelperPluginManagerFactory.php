<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\View;

use Interop\Container\ContainerInterface;
use Zend\Form\ConfigProvider as FormConfigProvider;
use Zend\I18n\ConfigProvider as I18nConfigProvider;
use Zend\View\HelperPluginManager;

/**
 * Class HelperPluginManagerFactory
 *
 * @package App\View
 */
class HelperPluginManagerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HelperPluginManager
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config')
            ? $container->get('config')
            : [];
        $config = isset($config['view_helpers'])
            ? $config['view_helpers']
            : [];

        $formConfigProvider = new FormConfigProvider();
        $i18nConfigProvider = new I18nConfigProvider();

        $config = array_merge_recursive(
            $config,
            $formConfigProvider->getViewHelperConfig(),
            $i18nConfigProvider->getViewHelperConfig()
        );

        $manager = new HelperPluginManager($container, $config);

        return $manager;
    }
}