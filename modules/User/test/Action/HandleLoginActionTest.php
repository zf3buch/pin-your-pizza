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
use stdClass;
use User\Action\HandleLoginAction;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Adapter\DbTable\AbstractAdapter;
use Zend\Authentication\Adapter\DbTable\Exception\RuntimeException;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Authentication\Storage\StorageInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HandleLoginActionTest
 *
 * @package UserTest\Action
 */
class HandleLoginActionTest extends AbstractTest
{
    /**
     * @var AdapterInterface|ValidatableAdapterInterface|AbstractAdapter
     */
    protected $authAdapter;

    /**
     * @var StorageInterface
     */
    protected $authStorage;

    /**
     * @var Result
     */
    protected $authResult;

    /**
     * Mock authentication service
     */
    protected function mockAuthService()
    {
        $this->authService = $this->prophesize(
            AuthenticationService::class
        );
    }

    /**
     * Prepare login form
     *
     * @param array $postData
     * @param bool  $isValid
     */
    protected function prepareLoginForm($postData, $isValid = true, $getData = false)
    {
        /** @var MethodProphecy $method */
        $method = $this->loginForm->setData($postData);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->loginForm->isValid();
        $method->willReturn($isValid);
        $method->shouldBeCalled();

        if ($getData) {
            /** @var MethodProphecy $method */
            $method = $this->loginForm->getData();
            $method->willReturn($postData);
            $method->shouldBeCalled();
        }
    }

    /**
     * Prepare authentication service
     *
     * @param bool $called
     * @param bool $calledStorage
     * @param null $exception
     */
    protected function prepareAuthService(
        $called = true,
        $calledStorage = true,
        $exception = null
    ) {
        /** @var MethodProphecy $method */
        $method = $this->authService->getAdapter();
        $method->willReturn($this->authAdapter);

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }

        /** @var MethodProphecy $method */
        $method = $this->authService->authenticate();

        if ($exception) {
            $method->willThrow($exception);
        } else {
            $method->willReturn($this->authResult);
        }

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }

        /** @var MethodProphecy $method */
        $method = $this->authService->getStorage();
        $method->willReturn($this->authStorage);

        if ($calledStorage) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }
    }

    /**
     * Prepare authentication adapter
     *
     * @param  array $postData
     * @param bool   $called
     * @param bool   $calledResult
     */
    protected function prepareAuthAdapter(
        $postData,
        $called = true,
        $calledResult = true
    ) {
        /** @var MethodProphecy $method */
        $method = $this->authAdapter->setIdentity($postData['email']);
        $method->willReturn($this->authAdapter);

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }

        /** @var MethodProphecy $method */
        $method = $this->authAdapter->setCredential($postData['password']);
        $method->willReturn($this->authAdapter);

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }

        /** @var MethodProphecy $method */
        $method = $this->authAdapter->getResultRowObject(
            null, ['password']
        );
        $method->willReturn(new stdClass());

        if ($calledResult) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }
    }

    /**
     * Prepare authentication result
     *
     * @param bool $isValid
     * @param bool $called
     * @param null $code
     */
    protected function prepareAuthResult(
        $isValid = true,
        $called = true,
        $code = null
    ) {
        /** @var MethodProphecy $method */
        $method = $this->authResult->isValid();
        $method->willReturn($isValid);

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }

        if ($isValid === false) {
            /** @var MethodProphecy $method */
            $method = $this->authResult->getCode();
            $method->willReturn($code);
            $method->shouldBeCalled();
        } else {
            /** @var MethodProphecy $method */
            $method = $this->authResult->getCode();
            $method->shouldNotBeCalled();
        }
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockLoginForm();
        $this->mockAuthService();

        $this->authAdapter = $this->prophesize(AbstractAdapter::class);
        $this->authStorage = $this->prophesize(StorageInterface::class);
        $this->authResult  = $this->prophesize(Result::class);
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
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->prepareLoginForm($postData, true, true);
        $this->prepareAuthService();
        $this->prepareAuthAdapter($postData);
        $this->prepareAuthResult();

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, new Response()
        );

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }

    /**
     * Test Response object
     */
    public function testResponseWithInvalidData()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareLoginForm($postData, false);
        $this->prepareAuthService(false, false);
        $this->prepareAuthAdapter($postData, false, false);
        $this->prepareAuthResult(true, false);

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
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

    /**
     * Test Response object
     */
    public function testResponseWithInvalidResultPassword()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;
        $authError   = 'user_authentication_password_invalid';

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareLoginForm($postData, true, true);
        $this->prepareAuthService(true, false);
        $this->prepareAuthAdapter($postData, true, false);
        $this->prepareAuthResult(
            false, true, Result::FAILURE_CREDENTIAL_INVALID
        );

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute(
            'auth_error', $authError
        );

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

    /**
     * Test Response object
     */
    public function testResponseWithInvalidResultEmail()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;
        $authError   = 'user_authentication_email_unknown';

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareLoginForm($postData, true, true);
        $this->prepareAuthService(true, false);
        $this->prepareAuthAdapter($postData, true, false);
        $this->prepareAuthResult(
            false, true, Result::FAILURE_IDENTITY_NOT_FOUND
        );

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute(
            'auth_error', $authError
        );

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

    /**
     * Test Response object
     */
    public function testResponseWithException()
    {
        $lang        = 'de';
        $uri         = '/' . $lang . '/user/login';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $postData    = [
            'email'      => 'Email',
            'password'   => 'password',
            'login_user' => 'login_user',
        ];
        $requestUri  = $uri;
        $authError   = 'user_authentication_email_unknown';

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareLoginForm($postData, true, true);
        $this->prepareAuthService(true, false, RuntimeException::class);
        $this->prepareAuthAdapter($postData, true, false);
        $this->prepareAuthResult(true, false);

        $action = new HandleLoginAction();
        $action->setRouter($this->router->reveal());
        $action->setAuthenticationService(
            $this->authService->reveal()
        );
        $action->setLoginForm(
            $this->loginForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute(
            'auth_error', $authError
        );

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
