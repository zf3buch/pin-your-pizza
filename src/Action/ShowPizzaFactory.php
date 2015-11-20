<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Application\Model\Service\PizzaServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowPizzaFactory
 *
 * @package Application\Action
 */
class ShowPizzaFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowPizzaAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $service  = $container->get(PizzaServiceInterface::class);

        return new ShowPizzaAction($template, $service);
    }
}
