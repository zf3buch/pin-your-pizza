<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use Prophecy\Prophecy\MethodProphecy;
use User\Action\HandleLogoutAction;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HandleLogoutActionTest
 *
 * @package UserTest\Action
 */
class HandleLogoutActionTest extends AbstractTest
{
    /**
     * Prepare authentication service
     */
    protected function prepareAuthService()
    {
        /** @var MethodProphecy $method */
        $method = $this->authService->clearIdentity();
        $method->shouldBeCalled();
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockAuthService();
    }

    /**
     * Test Response object
     */
    public function testResponseWithValidData()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/logout';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'user-intro';
        $requestUri  = $uri;

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->prepareAuthService();

        $action = new HandleLogoutAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);

        $serverResponse = new Response();

        /** @var RedirectResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
