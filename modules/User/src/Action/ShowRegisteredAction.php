<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Action;

use Application\Template\TemplateRendererAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use User\Form\LoginForm;
use User\Form\LoginFormAwareTrait;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowRegisteredAction
 *
 * @package User\Action
 */
class ShowRegisteredAction
{
    /**
     * use traits
     */
    use TemplateRendererAwareTrait;
    use LoginFormAwareTrait;

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
            'loginForm' => $this->loginForm,
        ];

        return new HtmlResponse(
            $this->template->render('user::registered', $data)
        );
    }
}
