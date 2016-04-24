<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest\Template;

use Application\Template\TemplateRendererAwareTrait;
use PHPUnit_Framework_TestCase;
use Zend\Expressive\ZendView\ZendViewRenderer;

/**
 * Class TemplateRendererAwareTraitTest
 *
 * @package ApplicationTest\Template
 */
class TemplateRendererAwareTraitTest extends PHPUnit_Framework_TestCase
{
    use TemplateRendererAwareTrait;

    /**
     * Test setter from trait
     */
    public function testSetterFromTrait()
    {
        $templateRenderer = new ZendViewRenderer();

        $this->setTemplateRenderer($templateRenderer);

        $this->assertEquals($templateRenderer, $this->template);
    }
}
