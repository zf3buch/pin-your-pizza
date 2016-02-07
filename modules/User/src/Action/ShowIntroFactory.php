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
use User\Form\RegisterForm;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowIntroFactory
 *
 * @package User\Action
 */
class ShowIntroFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowIntroAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template     = $container->get(TemplateRendererInterface::class);
        $loginForm    = $container->get(LoginForm::class);
        $registerForm = $container->get(RegisterForm::class);

        $action = new ShowIntroAction();
        $action->setTemplateRenderer($template);
        $action->setLoginForm($loginForm);
        $action->setRegisterForm($registerForm);

        return $action;
    }
}
