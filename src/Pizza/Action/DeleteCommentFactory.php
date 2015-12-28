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
use Pizza\Model\Repository\CommentRepositoryInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class DeleteCommentFactory
 *
 * @package Pizza\Action
 */
class DeleteCommentFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return DeleteCommentAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router     = $container->get(RouterInterface::class);
        $repository = $container->get(CommentRepositoryInterface::class);

        return new DeleteCommentAction(
            $router, $repository
        );
    }
}
