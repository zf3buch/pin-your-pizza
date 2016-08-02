<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use User\Authorization\AuthorizationMiddleware;
use User\Permissions\Rbac;
use Zend\Authentication\Exception\RuntimeException;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router\RouteResult;

/**
 * Class AuthorizationMiddlewareTest
 *
 * @package UserTest\Action
 */
class AuthorizationMiddlewareTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
    }

    /**
     * Test with no RouteResult object
     */
    public function testWithNoRouteResult()
    {
        $role = 'guest';

        /** @var Rbac $rbac */
        $rbac = $this->prophesize(Rbac::class);

        $middleware = new AuthorizationMiddleware(
            $role, $rbac->reveal()
        );

        $serverRequest = new ServerRequest();

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }

    /**
     * Test with RouteResult object and authorized
     */
    public function testWithRouteResultAuthorized()
    {
        $role      = 'guest';
        $routeName = 'allowed-route';

        /** @var Rbac $rbac */
        $rbac = $this->prophesize(Rbac::class);
        $rbac->isGranted($role, $routeName)->willReturn(true)
            ->shouldBeCalled();

        $middleware = new AuthorizationMiddleware(
            $role, $rbac->reveal()
        );

        $routeResult = RouteResult::fromRouteMatch(
            $routeName,
            'function',
            []
        );

        $serverRequest = new ServerRequest();
        $serverRequest = $serverRequest->withAttribute(
            RouteResult::class,
            $routeResult
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }

    /**
     * Test with RouteResult object and unauthorized
     */
    public function testWithRouteResultUnauthorized()
    {
        $role      = 'guest';
        $routeName = 'not-allowed-route';

        /** @var Rbac $rbac */
        $rbac = $this->prophesize(Rbac::class);
        $rbac->isGranted($role, $routeName)->willReturn(false)
            ->shouldBeCalled();

        $middleware = new AuthorizationMiddleware(
            $role, $rbac->reveal()
        );

        $routeResult = RouteResult::fromRouteMatch(
            $routeName,
            'function',
            []
        );

        $serverRequest = new ServerRequest();
        $serverRequest = $serverRequest->withAttribute(
            RouteResult::class,
            $routeResult
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('user_heading_unauthorized');
        $this->expectExceptionCode(401);

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);
    }

    /**
     * Test with RouteResult object and forbidden
     */
    public function testWithRouteResultForbidden()
    {
        $role      = 'member';
        $routeName = 'not-allowed-route';

        /** @var Rbac $rbac */
        $rbac = $this->prophesize(Rbac::class);
        $rbac->isGranted($role, $routeName)->willReturn(false)
            ->shouldBeCalled();

        $middleware = new AuthorizationMiddleware(
            $role, $rbac->reveal()
        );

        $routeResult = RouteResult::fromRouteMatch(
            $routeName,
            'function',
            []
        );

        $serverRequest = new ServerRequest();
        $serverRequest = $serverRequest->withAttribute(
            RouteResult::class,
            $routeResult
        );

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('user_heading_forbidden');
        $this->expectExceptionCode(403);

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);
    }
}
