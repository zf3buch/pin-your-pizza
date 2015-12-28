<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowIntroAction
 *
 * @package User\Action
 */
class ShowIntroAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * @var RegisterForm
     */
    private $registerForm;

    /**
     * ShowIntroAction constructor.
     *
     * @param TemplateRendererInterface $template
     * @param LoginForm                 $loginForm
     * @param RegisterForm              $registerForm
     */
    public function __construct(
        TemplateRendererInterface $template,
        LoginForm $loginForm,
        RegisterForm $registerForm
    ) {
        $this->template     = $template;
        $this->loginForm    = $loginForm;
        $this->registerForm = $registerForm;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $data = [
            'loginForm'    => $this->loginForm,
            'registerForm' => $this->registerForm,
            'authError'    => $request->getAttribute('auth_error'),
        ];

        return new HtmlResponse(
            $this->template->render('user::intro', $data)
        );
    }
}
