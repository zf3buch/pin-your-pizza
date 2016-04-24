<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest\View\Renderer;

use Application\View\Model\LayoutModel;
use Application\View\Renderer\ViewRendererFactory;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Expressive\ZendView\ZendViewRenderer;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;

/**
 * Class ViewRendererFactoryTest
 *
 * @package ApplicationTest\View\Renderer
 */
class ViewRendererFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    protected $container;

    /**
     * @var LayoutModel
     */
    protected $layoutModel;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->container = $this->prophesize(ServiceManager::class);

        $this->layoutModel = $this->prophesize(LayoutModel::class);
    }

    /**
     * Test factory without template config
     */
    public function testFactoryWithoutTemplateConfig()
    {
        $config = [];

        /** @var MethodProphecy $method */
        $method = $this->container->has('config');
        $method->willReturn(true);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->get('config');
        $method->willReturn($config);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->get(LayoutModel::class);
        $method->willReturn($this->layoutModel);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->has(HelperPluginManager::class);
        $method->willReturn(false);
        $method->shouldBeCalled();

        $factory = new ViewRendererFactory();

        $this->assertTrue(
            $factory instanceof ViewRendererFactory
        );

        /** @var ZendViewRenderer $helperPluginManager */
        $helperPluginManager = $factory($this->container->reveal());

        $this->assertTrue(
            $helperPluginManager instanceof ZendViewRenderer
        );
    }

    /**
     * Test factory with template config
     */
    public function testFactoryWithTemplateConfig()
    {
        $config = [
            'templates' => [],
        ];

        $extendedConfig = [
            'templates' => [
                'layout'    => $this->layoutModel->reveal(),
            ],
        ];

        /** @var MethodProphecy $method */
        $method = $this->container->has('config');
        $method->willReturn(true);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->get('config');
        $method->willReturn($config);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->get(LayoutModel::class);
        $method->willReturn($this->layoutModel);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->setAllowOverride(true);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->setService('config', $extendedConfig);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->setAllowOverride(false);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->has(HelperPluginManager::class);
        $method->willReturn(false);
        $method->shouldBeCalled();

        $factory = new ViewRendererFactory();

        $this->assertTrue(
            $factory instanceof ViewRendererFactory
        );

        /** @var ZendViewRenderer $helperPluginManager */
        $helperPluginManager = $factory($this->container->reveal());

        $this->assertTrue(
            $helperPluginManager instanceof ZendViewRenderer
        );
    }
}
