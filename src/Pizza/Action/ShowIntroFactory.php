<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Model\Service\PizzaServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowIntroFactory
 *
 * @package Application\Action
 */
class ShowIntroFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowIntroAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $service  = $container->get(PizzaServiceInterface::class);

        return new ShowIntroAction($template, $service);
    }
}
