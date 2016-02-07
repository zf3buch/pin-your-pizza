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
use Zend\Expressive\Router\RouterInterface;

/**
 * Class RedirectIntroFactory
 *
 * @package Pizza\Action
 */
class RedirectIntroFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RedirectIntroAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router = $container->get(RouterInterface::class);

        $action = new RedirectIntroAction();
        $action->setRouter($router);

        return $action;
    }
}
