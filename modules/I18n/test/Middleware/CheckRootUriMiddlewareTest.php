<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\Action;

use I18n\Middleware\CheckRootUriMiddleware;
use PHPUnit_Framework_TestCase;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class CheckRootUriMiddlewareTest
 *
 * @package I18nTest\Action
 */
class CheckRootUriMiddlewareTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test expected redirect
     */
    public function testExpectedRedirect()
    {
        $requestUri = '/';
        $expectedUri = '/de';

        $middleware = new CheckRootUriMiddleware();

        $serverRequest = new ServerRequest([], [], $requestUri);

        $serverResponse = new Response();

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals(
            [$expectedUri], $response->getHeader('location')
        );
    }

    /**
     * Test expected next middleware
     */
    public function testExpectedNext()
    {
        $requestUri = '/de';

        $middleware = new CheckRootUriMiddleware();

        $serverRequest = new ServerRequest([], [], $requestUri);

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
}
