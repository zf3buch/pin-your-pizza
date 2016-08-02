<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest\View\Model;

use Application\View\Model\LayoutFactory;
use Application\View\Model\LayoutModel;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Model\ViewModel;

/**
 * Class LayoutFactoryTest
 *
 * @package ApplicationTest\View\Model
 */
class LayoutFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    protected $container;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->container = $this->prophesize(ServiceManager::class);

    }

    /**
     * Test factory with no layout and no segments set
     */
    public function testFactoryWithNoLayoutAndNoSegments()
    {
        $layoutTemplate = 'layout/default';

        $config = [];

        $this->container->get('config')->willReturn($config)
            ->shouldBeCalled();

        $factory = new LayoutFactory();

        /** @var LayoutModel $layoutModel */
        $layoutModel = $factory($this->container->reveal());

        $this->assertTrue($layoutModel instanceof LayoutModel);
        $this->assertEquals($layoutTemplate, $layoutModel->getTemplate());
        $this->assertFalse($layoutModel->hasChildren());
    }

    /**
     * Test factory with layout and segments set
     */
    public function testFactoryWithLayoutAndSegments()
    {
        $layoutTemplate = 'layout/test';

        $config = [
            'templates' => [
                'layout'          => $layoutTemplate,
                'layout_segments' => ['layout/header', 'layout/footer'],
            ],
        ];

        $this->container->get('config')->willReturn($config)
            ->shouldBeCalled();

        $factory = new LayoutFactory();

        /** @var LayoutModel $layoutModel */
        $layoutModel = $factory($this->container->reveal());

        $this->assertTrue($layoutModel instanceof LayoutModel);
        $this->assertEquals($layoutTemplate, $layoutModel->getTemplate());
        $this->assertTrue($layoutModel->hasChildren());

        $layoutSegment1 = new ViewModel();
        $layoutSegment1->setTemplate('layout/header');
        $layoutSegment1->setCaptureTo('header');

        $layoutSegment2 = new ViewModel();
        $layoutSegment2->setTemplate('layout/footer');
        $layoutSegment2->setCaptureTo('footer');

        $this->assertEquals(
            [$layoutSegment1, $layoutSegment2], $layoutModel->getChildren()
        );
    }
}
