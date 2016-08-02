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
use User\Authorization\AuthorizationMiddleware;
use User\Authorization\AuthorizationMiddlewareFactory;
use User\Permissions\Rbac;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Diactoros\Response;

/**
 * Class AuthorizationMiddlewareFactoryTest
 *
 * @package UserTest\Action
 */
class AuthorizationMiddlewareFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var AuthenticationServiceInterface
     */
    protected $authService;

    /**
     * @var Rbac
     */
    protected $rbac;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->authService = $this->prophesize(
            AuthenticationServiceInterface::class
        );

        $this->rbac = $this->prophesize(Rbac::class);

        $this->container = $this->prophesize(ContainerInterface::class);
        $this->container->get(AuthenticationServiceInterface::class)
            ->willReturn($this->authService)->shouldBeCalled();
        $this->container->get(Rbac::class)->willReturn($this->rbac)
            ->shouldBeCalled();
    }

    /**
     * Test factory with identity
     */
    public function testFactoryWithIdentity()
    {
        $role = 'member';

        $identity = (object)['role' => $role];

        $this->authService->hasIdentity()->willReturn(true)
            ->shouldBeCalled();

        $this->authService->getIdentity()->willReturn($identity)
            ->shouldBeCalled();

        $factory = new AuthorizationMiddlewareFactory();

        /** @var AuthorizationMiddleware $middleware */
        $middleware = $factory($this->container->reveal());

        $this->assertTrue($middleware instanceof AuthorizationMiddleware);

        $this->assertAttributeEquals($role, 'role', $middleware);
        $this->assertAttributeEquals(
            $this->rbac->reveal(), 'rbac', $middleware
        );
    }

    /**
     * Test factory with no identity
     */
    public function testFactoryWithNoIdentity()
    {
        $role = 'guest';

        $this->authService->hasIdentity()->willReturn(false)
            ->shouldBeCalled();

        $factory = new AuthorizationMiddlewareFactory();

        /** @var AuthorizationMiddleware $middleware */
        $middleware = $factory($this->container->reveal());

        $this->assertTrue($middleware instanceof AuthorizationMiddleware);

        $this->assertAttributeEquals($role, 'role', $middleware);
        $this->assertAttributeEquals(
            $this->rbac->reveal(), 'rbac', $middleware
        );
    }
}
