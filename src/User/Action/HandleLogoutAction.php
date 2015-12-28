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
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleLogoutAction
 *
 * @package User\Action
 */
class HandleLogoutAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var AuthenticationServiceInterface|AuthenticationService
     */
    private $authenticationService;

    /**
     * HandleLogoutAction constructor.
     *
     * @param RouterInterface                $router
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(
        RouterInterface $router,
        AuthenticationServiceInterface $authenticationService
    ) {
        $this->router                = $router;
        $this->authenticationService = $authenticationService;
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
        $this->authenticationService->clearIdentity();

        $routeParams = [
            'lang' => $request->getAttribute('lang'),
        ];

        return new RedirectResponse(
            $this->router->generateUri('user-intro', $routeParams)
        );
    }
}
