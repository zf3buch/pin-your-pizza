<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Model\Service\PizzaServiceInterface;
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
        $router  = $container->get(RouterInterface::class);
        $service = $container->get(PizzaServiceInterface::class);

        return new HandleCommentAction($router, $service);
    }
}
