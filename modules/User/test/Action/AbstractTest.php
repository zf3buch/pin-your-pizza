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
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Model\Repository\UserRepositoryInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
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
    protected $renderer;

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
     * Mock renderer
     */
    protected function mockRenderer()
    {
        $this->renderer = $this->prophesize(
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
            $this->container->get(RouterInterface::class)
                ->willReturn($this->router)->shouldBeCalled();
        }

        if (in_array('renderer', $map)) {
            $this->container->get(TemplateRendererInterface::class)
                ->willReturn($this->renderer)->shouldBeCalled();
        }

        if (in_array('authService', $map)) {
            $this->container->get(AuthenticationServiceInterface::class)
                ->willReturn($this->authService)->shouldBeCalled();
        }

        if (in_array('userRepository', $map)) {
            $this->container->get(UserRepositoryInterface::class)
                ->willReturn($this->userRepository)->shouldBeCalled();
        }

        if (in_array('registerForm', $map)) {
            $this->container->get(RegisterForm::class)
                ->willReturn($this->registerForm)->shouldBeCalled();
        }

        if (in_array('loginForm', $map)) {
            $this->container->get(LoginForm::class)
                ->willReturn($this->loginForm)->shouldBeCalled();
        }
    }

    /**
     * Prepare renderer mock
     *
     * @param string $rendererName
     * @param array  $rendererVars
     */
    protected function prepareRenderer($rendererName, $rendererVars)
    {
        $this->renderer->render($rendererName, $rendererVars)
            ->willReturn('Whatever')->shouldBeCalled();
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
        $method = $this->router->generateUri($routeName, $routeParams);
        $method->willReturn($uri);

        if ($called) {
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }
    }
}
