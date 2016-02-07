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
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleLoginAction
 *
 * @package User\Action
 */
class HandleLoginAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * HandleLoginAction constructor.
     *
     * @param RouterInterface $router
     * @param LoginForm       $loginForm
     */
    public function __construct(
        RouterInterface $router,
        LoginForm $loginForm
    ) {
        $this->router    = $router;
        $this->loginForm = $loginForm;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return RedirectResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $routeParams = [
            'lang' => $request->getAttribute('lang'),
        ];

        return new RedirectResponse(
            $this->router->generateUri('user-intro', $routeParams)
        );
    }
}
