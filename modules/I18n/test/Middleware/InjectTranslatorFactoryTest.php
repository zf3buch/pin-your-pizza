<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\Action;

use I18n\Middleware\InjectTranslatorFactory;
use I18n\Middleware\InjectTranslatorMiddleware;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\I18n\Translator\Translator;
use Zend\View\HelperPluginManager;

/**
 * Class InjectTranslatorFactoryTest
 *
 * @package I18nTest\Action
 */
class InjectTranslatorFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var HelperPluginManager
     */
    protected $helperPluginManager;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->translator = $this->prophesize(Translator::class);

        $this->helperPluginManager = $this->prophesize(
            HelperPluginManager::class
        );
    }

    /**
     * Test translator injection
     */
    public function testTranslatorInjection()
    {
        $this->container->get(Translator::class)
            ->willReturn($this->translator)->shouldBeCalled();

        $this->container->get(HelperPluginManager::class)
            ->willReturn($this->helperPluginManager)->shouldBeCalled();

        $factory = new InjectTranslatorFactory();

        /** @var InjectTranslatorMiddleware $middleware */
        $middleware = $factory($this->container->reveal());

        $this->assertTrue(
            $middleware instanceof InjectTranslatorMiddleware
        );

        $this->assertAttributeEquals(
            $this->translator->reveal(), 'translator', $middleware
        );

        $this->assertAttributeEquals(
            $this->helperPluginManager->reveal(),
            'helperPluginManager',
            $middleware
        );
    }
}
