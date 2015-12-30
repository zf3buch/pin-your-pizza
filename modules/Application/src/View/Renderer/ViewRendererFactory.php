<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\View\Renderer;

use Application\View\Model\LayoutModel;
use Interop\Container\ContainerInterface;
use Zend\Expressive\ZendView\ZendViewRenderer;
use Zend\Expressive\ZendView\ZendViewRendererFactory;
use Zend\ServiceManager\ServiceManager;

/**
 * Class ViewRendererFactory
 *
 * @package Application\View\Renderer
 */
class ViewRendererFactory extends ZendViewRendererFactory
{
    /**
     * Create and return an Application instance.
     *
     * @param ContainerInterface|ServiceManager $container
     *
     * @return ZendViewRenderer
     */
    public function __invoke(ContainerInterface $container)
    {
        $config      = $container->get('config');
        $layoutModel = $container->get(LayoutModel::class);

        if (isset($config['templates']) && $layoutModel) {
            $config['templates']['layout'] = $layoutModel;

            $container->setAllowOverride(true);
            $container->setService('config', $config);
            $container->setAllowOverride(false);
        }

        return parent::__invoke($container);
    }
}
