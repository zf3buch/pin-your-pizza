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
        $router  = $container->get(RouterInterface::class);
        $service = $container->get(PizzaServiceInterface::class);

        return new HandleVoteAction($router, $service);
    }
}
