<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Form;

/**
 * Trait LoginFormAwareTrait
 *
 * @package User\Form
 */
class LoginFormAwareTrait
{
    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * @param LoginForm $loginForm
     */
    public function setLoginForm(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;
    }
}
