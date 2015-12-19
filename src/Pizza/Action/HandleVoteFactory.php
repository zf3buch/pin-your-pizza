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
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleVoteFactory
 *
 * @package Application\Action
 */
class HandleVoteFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HandleVoteAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router     = $container->get(RouterInterface::class);
        $repository = $container->get(PizzaRepositoryInterface::class);

        return new HandleVoteAction($router, $repository);
    }
}
