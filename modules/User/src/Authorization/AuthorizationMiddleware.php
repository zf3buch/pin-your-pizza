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
use Zend\Expressive\Router\RouteResultSubjectInterface;

/**
 * Class AuthorizationMiddleware
 *
 * @package User\Authorization
 */
class AuthorizationMiddleware
{
    /**
     * @var AuthorizationObserver
     */
    private $observer;

    /**
     * @var RouteResultSubjectInterface
     */
    private $subject;

    /**
     * AuthorizationMiddleware constructor.
     *
     * @param AuthorizationObserver $observer
     * @param RouteResultSubjectInterface $subject
     */
    public function __construct(
        AuthorizationObserver $observer,
        RouteResultSubjectInterface $subject
    ) {
        $this->observer = $observer;
        $this->subject  = $subject;
    }

    /**
     * Attach the AuthorizationObserver instance to the
     * RouteResultSubjectInterface
     *
     * Attaches the observer, and then dispatches the next middleware.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        $this->subject->attachRouteResultObserver($this->observer);

        return $next($request, $response);
    }
}
