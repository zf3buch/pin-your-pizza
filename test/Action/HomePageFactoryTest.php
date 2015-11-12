<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest\Action;

use Application\Action\HomePageAction;
use Application\Action\HomePageFactory;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerInterface */
    protected $container;

    public function setUp()
    {
        $template = $this->prophesize(TemplateRendererInterface::class);

        $this->container = $this->prophesize(ContainerInterface::class);
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($template);
    }

    public function testFactoryWithTemplate()
    {
        $factory = new HomePageFactory();

        $this->assertTrue($factory instanceof HomePageFactory);

        $homePage = $factory($this->container->reveal());

        $this->assertTrue($homePage instanceof HomePageAction);
    }
}
