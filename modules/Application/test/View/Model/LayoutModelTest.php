<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest\View\Model;

use Application\View\Model\LayoutModel;
use PHPUnit_Framework_TestCase;
use Zend\View\Model\ViewModel;

/**
 * Class LayoutModelTest
 *
 * @package ApplicationTest\View\Model
 */
class LayoutModelTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test adding no layout segments
     */
    public function testAddingNoSegments()
    {
        $layoutModel = new LayoutModel();

        $this->assertFalse($layoutModel->hasChildren());
    }

    /**
     * Test adding one layout segment
     */
    public function testAddingOneSegment()
    {
        $layoutModel = new LayoutModel();
        $layoutModel->addLayoutSegments(['layout/header']);

        $this->assertTrue($layoutModel->hasChildren());

        $layoutSegment = new ViewModel();
        $layoutSegment->setTemplate('layout/header');
        $layoutSegment->setCaptureTo('header');

        $this->assertEquals([$layoutSegment], $layoutModel->getChildren());
    }

    /**
     * Test adding two layout segments
     */
    public function testAddingTwoSegments()
    {
        $layoutModel = new LayoutModel();
        $layoutModel->addLayoutSegments(
            ['layout/header', 'layout/footer']
        );

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
