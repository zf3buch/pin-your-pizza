<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Authentication;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use User\Authentication\AuthenticationServiceFactory;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;

/**
 * Class AuthenticationServiceFactoryTest
 *
 * @package UserTest\Authentication
 */
class AuthenticationServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->adapter = $this->prophesize(AdapterInterface::class);

        $this->container = $this->prophesize(ContainerInterface::class);
        $this->container->get(AdapterInterface::class)
            ->willReturn($this->adapter)->shouldBeCalled();
    }

    /**
     * Test factory
     */
    public function testFactory()
    {
        $factory = new AuthenticationServiceFactory();

        /** @var AuthenticationService $authService */
        $authService = $factory($this->container->reveal());

        $this->assertTrue($authService instanceof AuthenticationService);

        $this->assertAttributeEquals(
            $this->adapter->reveal(), 'adapter', $authService
        );
    }
}
