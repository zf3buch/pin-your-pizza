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
use User\Form\RegisterForm;
use User\Model\Repository\UserRepositoryInterface;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleRegisterFactory
 *
 * @package User\Action
 */
class HandleRegisterFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HandleRegisterAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router     = $container->get(RouterInterface::class);
        $repository = $container->get(UserRepositoryInterface::class);
        $form       = $container->get(RegisterForm::class);

        $action = new HandleRegisterAction();
        $action->setRouter($router);
        $action->setUserRepository($repository);
        $action->setRegisterForm($form);

        return $action;
    }
}
