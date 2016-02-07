<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Action;

use Application\Router\RouterAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use User\Authentication\AuthenticationServiceAwareTrait;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class HandleLogoutAction
 *
 * @package User\Action
 */
class HandleLogoutAction
{
    /**
     * use traits
     */
    use RouterAwareTrait;
    use AuthenticationServiceAwareTrait;

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
