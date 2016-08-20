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
use Pizza\Form\CommentForm;
use Pizza\Model\Repository\PizzaRepositoryInterface;
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
        $renderer   = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(PizzaRepositoryInterface::class);
        $form       = $container->get(CommentForm::class);

        $action = new ShowPizzaAction();
        $action->setTemplateRenderer($renderer);
        $action->setPizzaRepository($repository);
        $action->setCommentForm($form);

        return $action;
    }
}
