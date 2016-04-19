<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Prophecy\Exception\Call\UnexpectedCallException;
use Prophecy\Prophecy\MethodProphecy;
use User\Action\ShowRegisteredAction;
use User\Action\ShowRegisteredFactory;
use User\Form\LoginForm;
use User\Model\Repository\UserRepositoryInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowRegisteredFactoryTest
 *
 * @package UserTest\Action
 */
class ShowRegisteredFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockTemplate();
        $this->mockLoginForm();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(['template', 'loginForm']);

        $factory = new ShowRegisteredFactory();

        $this->assertTrue($factory instanceof ShowRegisteredFactory);

        /** @var ShowRegisteredAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof ShowRegisteredAction);

        $this->assertAttributeEquals(
            $this->template->reveal(), 'template', $action
        );

        $this->assertAttributeEquals(
            $this->loginForm->reveal(),
            'loginForm',
            $action
        );
    }
}
