<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest\View;

use Application\View\HelperPluginManagerFactory;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Zend\View\HelperPluginManager;

/**
 * Class HelperPluginManagerFactoryTest
 *
 * @package ApplicationTest\View
 */
class HelperPluginManagerFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->container->has('config')->willReturn(true)
            ->shouldBeCalled();

        $this->container->get('config')->willReturn($this->config)
            ->shouldBeCalled();
    }

    /**
     * Test factory
     */
    public function testFactory()
    {
        $factory = new HelperPluginManagerFactory();

        /** @var HelperPluginManager $helperPluginManager */
        $helperPluginManager = $factory($this->container->reveal());

        $this->assertTrue($helperPluginManager instanceof HelperPluginManager);

        $this->assertTrue($helperPluginManager->has('ServerUrl'));
        $this->assertTrue($helperPluginManager->has('FormCaptchaImage'));
        $this->assertTrue($helperPluginManager->has('TranslatePlural'));
    }
}