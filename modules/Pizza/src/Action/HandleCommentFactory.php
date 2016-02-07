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
use Pizza\Model\Repository\CommentRepositoryInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleCommentFactory
 *
 * @package Application\Action
 */
class HandleCommentFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HandleCommentAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router     = $container->get(RouterInterface::class);
        $repository = $container->get(CommentRepositoryInterface::class);
        $form       = $container->get(CommentForm::class);

        $action = new HandleCommentAction();
        $action->setRouter($router);
        $action->setCommentRepository($repository);
        $action->setCommentForm($form);

        return $action;
    }
}
