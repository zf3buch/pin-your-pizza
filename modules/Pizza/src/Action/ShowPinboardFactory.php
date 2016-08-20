<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Interop\Container\ContainerInterface;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowPinboardFactory
 *
 * @package Application\Action
 */
class ShowPinboardFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowPinboardAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $renderer   = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(PizzaRepositoryInterface::class);

        $action = new ShowPinboardAction();
        $action->setTemplateRenderer($renderer);
        $action->setPizzaRepository($repository);

        return $action;
    }
}
