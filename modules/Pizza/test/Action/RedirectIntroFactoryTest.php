<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\RedirectIntroAction;
use Pizza\Action\RedirectIntroFactory;

/**
 * Class RedirectIntroFactoryTest
 *
 * @package PizzaTest\Action
 */
class RedirectIntroFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(['router']);

        $factory = new RedirectIntroFactory();

        /** @var RedirectIntroAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof RedirectIntroAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );
    }
}
