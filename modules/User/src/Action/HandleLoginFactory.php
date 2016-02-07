<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Action;

use Interop\Container\ContainerInterface;
use User\Form\LoginForm;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleLoginFactory
 *
 * @package User\Action
 */
class HandleLoginFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HandleLoginAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router = $container->get(RouterInterface::class);
        $form   = $container->get(LoginForm::class);

        $authService = $container->get(
            AuthenticationServiceInterface::class
        );

        $action = new HandleLoginAction();
        $action->setRouter($router);
        $action->setLoginForm($form);
        $action->setAuthenticationService($authService);

        return $action;
    }
}
