<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\View\Helper;

use I18n\View\Helper\UrlHelper;
use I18n\View\Helper\UrlHelperFactory;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class UrlHelperFactoryTest
 *
 * @package I18nTest\View\Helper
 */
class UrlHelperFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var array
     */
    protected $config
        = [
            'i18n' => [
                'defaultLang'    => 'de',
                'allowedLocales' => [
                    'de' => 'de_DE',
                    'en' => 'en_US',
                ],
                'defaultRoute'   => 'home',
            ],
        ];

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->router = $this->prophesize(RouterInterface::class);

        $this->container = $this->prophesize(ContainerInterface::class);

        $this->container->has(RouterInterface::class)->willReturn(true)
            ->shouldBeCalled();

        $this->container->get(RouterInterface::class)
            ->willReturn($this->router)->shouldBeCalled();

        $this->container->get('config')->willReturn($this->config)
            ->shouldBeCalled();
    }

    /**
     * Test factory
     */
    public function testFactory()
    {
        $factory = new UrlHelperFactory();

        /** @var UrlHelper $viewHelper */
        $viewHelper = $factory($this->container->reveal());

        $this->assertTrue($viewHelper instanceof UrlHelper);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $viewHelper
        );
    }
}
