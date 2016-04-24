<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\View\Helper;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use User\Permissions\Rbac;
use User\View\Helper\Identity;
use User\View\Helper\IdentityFactory;
use Zend\Authentication\AuthenticationServiceInterface;

/**
 * Class IdentityFactoryTest
 *
 * @package UserTest\View\Helper
 */
class IdentityFactoryTest extends PHPUnit_Framework_TestCase
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
     * Setup test cases
     */
    public function setUp()
    {
        $this->authService = $this->prophesize(
            AuthenticationServiceInterface::class
        );

        $this->container = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $method */
        $method = $this->container->get(
            AuthenticationServiceInterface::class
        );
        $method->willReturn($this->authService);
        $method->shouldBeCalled();
    }

    /**
     * Test factory with identity
     */
    public function testFactoryWithIdentity()
    {
        $role = 'member';

        $identity = (object)['role' => $role];

        /** @var MethodProphecy $method */
        $method = $this->authService->hasIdentity();
        $method->willReturn(true);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->authService->getIdentity();
        $method->willReturn($identity);
        $method->shouldBeCalled();

        $factory = new IdentityFactory();

        $this->assertTrue(
            $factory instanceof IdentityFactory
        );

        /** @var Identity $viewHelper */
        $viewHelper = $factory($this->container->reveal());

        $this->assertTrue($viewHelper instanceof Identity);

        $this->assertAttributeEquals($identity, 'identity', $viewHelper);
    }

    /**
     * Test factory without identity
     */
    public function testFactoryWithoutIdentity()
    {
        $role = 'guest';

        $identity = (object)['role' => $role];

        /** @var MethodProphecy $method */
        $method = $this->authService->hasIdentity();
        $method->willReturn(false);
        $method->shouldBeCalled();

        $factory = new IdentityFactory();

        $this->assertTrue(
            $factory instanceof IdentityFactory
        );

        /** @var Identity $viewHelper */
        $viewHelper = $factory($this->container->reveal());

        $this->assertTrue($viewHelper instanceof Identity);

        $this->assertAttributeEquals($identity, 'identity', $viewHelper);
    }
}
