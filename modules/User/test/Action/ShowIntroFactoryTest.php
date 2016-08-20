<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use User\Action\ShowIntroAction;
use User\Action\ShowIntroFactory;

/**
 * Class ShowIntroFactoryTest
 *
 * @package UserTest\Action
 */
class ShowIntroFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRenderer();
        $this->mockLoginForm();
        $this->mockRegisterForm();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(
            ['renderer', 'loginForm', 'registerForm']
        );

        $factory = new ShowIntroFactory();

        /** @var ShowIntroAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof ShowIntroAction);

        $this->assertAttributeEquals(
            $this->renderer->reveal(), 'renderer', $action
        );

        $this->assertAttributeEquals(
            $this->loginForm->reveal(),
            'loginForm',
            $action
        );

        $this->assertAttributeEquals(
            $this->registerForm->reveal(),
            'registerForm',
            $action
        );
    }
}
