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

        $this->container->has('config')->willReturn(true)
            ->shouldBeCalled();

        $this->container->get('config')->willReturn($config)
            ->shouldBeCalled();

        $this->container->get(LayoutModel::class)
            ->willReturn($this->layoutModel)->shouldBeCalled();

        $this->container->has(HelperPluginManager::class)
            ->willReturn(false)->shouldBeCalled();

        $factory = new ViewRendererFactory();

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

        $this->container->has('config')->willReturn(true)
            ->shouldBeCalled();

        $this->container->get('config')->willReturn($config)
            ->shouldBeCalled();

        $this->container->get(LayoutModel::class)
            ->willReturn($this->layoutModel)->shouldBeCalled();

        $this->container->setAllowOverride(true)->shouldBeCalled();

        $this->container->setService('config', $extendedConfig)
            ->shouldBeCalled();

        $this->container->setAllowOverride(false)->shouldBeCalled();

        $this->container->has(HelperPluginManager::class)
            ->willReturn(false)->shouldBeCalled();

        $factory = new ViewRendererFactory();

        /** @var ZendViewRenderer $helperPluginManager */
        $helperPluginManager = $factory($this->container->reveal());

        $this->assertTrue(
            $helperPluginManager instanceof ZendViewRenderer
        );
    }
}
