<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Model\Repository\UserRepositoryInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Diactoros\Response;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class AbstractTest
 *
 * @package UserTest\Action
 */
abstract class AbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var TemplateRendererInterface
     */
    protected $template;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var AuthenticationService|AuthenticationServiceInterface
     */
    protected $authService;

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var RegisterForm
     */
    protected $registerForm;

    /**
     * @var LoginForm
     */
    protected $loginForm;

    /**
     * Mock DI container
     */
    protected function mockDiContainer()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }

    /**
     * Mock template
     */
    protected function mockTemplate()
    {
        $this->template = $this->prophesize(
            TemplateRendererInterface::class
        );
    }

    /**
     * Mock router
     */
    protected function mockRouter()
    {
        $this->router = $this->prophesize(RouterInterface::class);
    }

    /**
     * Mock authentication service
     */
    protected function mockAuthService()
    {
        $this->authService = $this->prophesize(
            AuthenticationServiceInterface::class
        );
    }

    /**
     * Mock user repository
     */
    protected function mockUserRepository()
    {
        $this->userRepository = $this->prophesize(
            UserRepositoryInterface::class
        );
    }

    /**
     * Mock register form
     */
    protected function mockRegisterForm()
    {
        $this->registerForm = $this->prophesize(
            RegisterForm::class
        );
    }

    /**
     * Mock login form
     */
    protected function mockLoginForm()
    {
        $this->loginForm = $this->prophesize(
            LoginForm::class
        );
    }

    /**
     * Prepare DI container
     *
     * @param array $map
     */
    protected function prepareDiContainer($map = [])
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        if (in_array('router', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(RouterInterface::class);
            $method->willReturn($this->router);
            $method->shouldBeCalled();
        }

        if (in_array('template', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(
                TemplateRendererInterface::class
            );
            $method->willReturn($this->template);
            $method->shouldBeCalled();
        }

        if (in_array('authService', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(
                AuthenticationServiceInterface::class
            );
            $method->willReturn($this->authService);
            $method->shouldBeCalled();
        }

        if (in_array('userRepository', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(
                UserRepositoryInterface::class
            );
            $method->willReturn($this->userRepository);
            $method->shouldBeCalled();
        }

        if (in_array('registerForm', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(RegisterForm::class);
            $method->willReturn($this->registerForm);
            $method->shouldBeCalled();
        }

        if (in_array('loginForm', $map)) {
            /** @var MethodProphecy $method */
            $method = $this->container->get(LoginForm::class);
            $method->willReturn($this->loginForm);
            $method->shouldBeCalled();
        }
    }

    /**
     * Prepare template mock
     *
     * @param string $templateName
     * @param array  $templateVars
     */
    protected function prepareRenderer($templateName, $templateVars)
    {
        /** @var MethodProphecy $method */
        $method = $this->template->render($templateName, $templateVars);
        $method->willReturn('Whatever');
        $method->shouldBeCalled();
    }

    /**
     * Prepare router mock
     *
     * @param string $routeName
     * @param array  $routeParams
     * @param string $uri
     * @param bool   $called
     */
    protected function prepareRouter(
        $routeName,
        $routeParams,
        $uri,
        $called = true
    ) {
        /** @var MethodProphecy $method */
        $method = $this->router->generateUri($routeName, $routeParams);
        $method->willReturn($uri);

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }
    }
}
