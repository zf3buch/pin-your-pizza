<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Authorization;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use User\Permissions\Rbac;
use Zend\Authentication\Exception\RuntimeException;
use Zend\Expressive\Router\RouteResult;

/**
 * Class AuthorizationMiddleware
 *
 * @package User\Authorization
 */
class AuthorizationMiddleware
{
    /**
     * @var string
     */
    private $role;

    /**
     * @var Rbac
     */
    private $rbac;

    /**
     * Authorization constructor.
     *
     * @param string $role
     * @param Rbac   $rbac
     */
    public function __construct($role, Rbac $rbac)
    {
        $this->role = $role;
        $this->rbac = $rbac;
    }

    /**
     * Check the authorization with the current route name
     *
     * Throws an exception if the authorization failed, otherwise
     * dispatches the next middleware.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return ResponseInterface
     * @throws RuntimeException
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        $result = $request->getAttribute(RouteResult::class, false);

        $permission = $result->getMatchedRouteName();

        if (!$this->rbac->isGranted($this->role, $permission)) {
            throw new RuntimeException(
                'user_heading_not_allowed',
                403
            );
        }

        return $next($request, $response);
    }
}
