<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Application\Model\Repository\PizzaRepositoryInterface;
use Interop\Container\ContainerInterface;
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
        $repository = $container->get(PizzaRepositoryInterface::class);

        return new HandleCommentAction($router, $repository);
    }
}
