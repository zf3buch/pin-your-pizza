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
use User\Action\HandleRegisterAction;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HandleRegisterActionTest
 *
 * @package UserTest\Action
 */
class HandleRegisterActionTest extends AbstractTest
{
    /**
     * Prepare register form
     *
     * @param array      $setData
     * @param array|bool $getData
     * @param bool       $isValidReturn
     */
    protected function prepareRegisterForm(
        $setData,
        $getData,
        $isValidReturn = true
    )
    {
        /** @var MethodProphecy $method */
        $method = $this->registerForm->setData($setData);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->registerForm->getData();

        if ($getData) {
            $method->willReturn($getData);
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }

        /** @var MethodProphecy $method */
        $method = $this->registerForm->isValid();
        $method->willReturn($isValidReturn);
        $method->shouldBeCalled();
    }

    /**
     * Prepare user repository
     *
     * @param array $postData
     * @param bool  $called
     */
    protected function prepareUserRepository($postData, $called = true)
    {
        /** @var MethodProphecy $method */
        $method = $this->userRepository->registerUser($postData);

        if ($called) {
            $method->shouldBeCalled();
        }
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockUserRepository();
        $this->mockRegisterForm();
    }

    /**
     * Test Response object
     */
    public function testResponseWithValidData()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'user-registered';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->prepareRegisterForm($postData, $postData, true);
        $this->prepareUserRepository($postData, true);

        $action = new HandleRegisterAction();
        $action->setRouter($this->router->reveal());
        $action->setUserRepository(
            $this->userRepository->reveal()
        );
        $action->setRegisterForm(
            $this->registerForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);

        $serverResponse = new Response();

        /** @var RedirectResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }

    /**
     * Test Response object
     */
    public function testResponseWithInvalidData()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/register';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'user-registered';
        $postData    = [
            'email'         => 'Email',
            'password'      => 'password',
            'register_user' => 'register_user',
        ];
        $requestUri  = $uri;

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareRegisterForm($postData, false, false);
        $this->prepareUserRepository($postData, false);

        $action = new HandleRegisterAction();
        $action->setRouter($this->router->reveal());
        $action->setUserRepository(
            $this->userRepository->reveal()
        );
        $action->setRegisterForm(
            $this->registerForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, $serverResponse, $next
        );

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }
}
