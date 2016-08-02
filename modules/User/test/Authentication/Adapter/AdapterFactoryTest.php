<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Authentication\Adapter;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use User\Authentication\Adapter\AdapterFactory;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class AdapterFactoryTest
 *
 * @package UserTest\Authentication\Adapter
 */
class AdapterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var AdapterInterface
     */
    protected $dbAdapter;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $dbConfig = include __DIR__
            . '/../../../../../config/autoload/database.test.php';

        $this->dbAdapter = new Adapter($dbConfig['db']);

        $this->container = $this->prophesize(ContainerInterface::class);
        $this->container->get(AdapterInterface::class)
            ->willReturn($this->dbAdapter)->shouldBeCalled();
    }

    /**
     * Test factory
     */
    public function testFactory()
    {
        $factory = new AdapterFactory();

        /** @var CallbackCheckAdapter $authAdapter */
        $authAdapter = $factory($this->container->reveal());

        $this->assertTrue($authAdapter instanceof CallbackCheckAdapter);

        $this->assertAttributeEquals(
            $this->dbAdapter, 'zendDb', $authAdapter
        );
        $this->assertAttributeEquals(
            'user', 'tableName', $authAdapter
        );
        $this->assertAttributeEquals(
            'email', 'identityColumn', $authAdapter
        );
        $this->assertAttributeEquals(
            'password', 'credentialColumn', $authAdapter
        );
        $this->assertAttributeEquals(
            function ($hash, $password) {
                return password_verify($password, $hash);
            },
            'credentialValidationCallback',
            $authAdapter
        );
    }
}
