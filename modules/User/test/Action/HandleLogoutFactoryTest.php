<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use User\Action\HandleLogoutAction;
use User\Action\HandleLogoutFactory;

/**
 * Class HandleLogoutFactoryTest
 *
 * @package UserTest\Action
 */
class HandleLogoutFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockAuthService();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(
            ['router', 'authService']
        );

        $factory = new HandleLogoutFactory();

        /** @var HandleLogoutAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof HandleLogoutAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );

        $this->assertAttributeEquals(
            $this->authService->reveal(),
            'authenticationService',
            $action
        );
    }
}
