<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use User\Action\HandleLoginAction;
use User\Action\HandleLoginFactory;

/**
 * Class HandleLoginFactoryTest
 *
 * @package UserTest\Action
 */
class HandleLoginFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockLoginForm();
        $this->mockAuthService();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(
            ['router', 'loginForm', 'authService']
        );

        $factory = new HandleLoginFactory();

        $this->assertTrue($factory instanceof HandleLoginFactory);

        /** @var HandleLoginAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof HandleLoginAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );

        $this->assertAttributeEquals(
            $this->authService->reveal(),
            'authenticationService',
            $action
        );

        $this->assertAttributeEquals(
            $this->loginForm->reveal(),
            'loginForm',
            $action
        );
    }
}
