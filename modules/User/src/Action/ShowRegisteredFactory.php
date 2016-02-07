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
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowRegisteredFactory
 *
 * @package User\Action
 */
class ShowRegisteredFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ShowRegisteredAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template  = $container->get(TemplateRendererInterface::class);
        $loginForm = $container->get(LoginForm::class);

        $action = new ShowRegisteredAction();
        $action->setTemplateRenderer($template);
        $action->setLoginForm($loginForm);

        return $action;
    }
}
