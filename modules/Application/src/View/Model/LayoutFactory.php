<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\View\Model;

use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;

/**
 * Class Layout
 *
 * @package Application\View\Model
 */
class LayoutFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ViewModel
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = isset($config['templates']) ? $config['templates'] : [];

        $layout = 'layout/default';

        if (isset($config['layout'])) {
            $layout = $config['layout'];
        }

        $layoutModel = new LayoutModel();
        $layoutModel->setTemplate($layout);

        if (isset($config['layout_segments'])) {
            $layoutModel->addLayoutSegments($config['layout_segments']);
        }

        return $layoutModel;
    }
}
