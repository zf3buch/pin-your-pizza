<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\HandleVoteAction;
use Pizza\Action\HandleVoteFactory;

/**
 * Class HandleVoteFactoryTest
 *
 * @package PizzaTest\Action
 */
class HandleVoteFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockPizzaRepository();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->mockRouter();
        $this->mockPizzaRepository();
        $this->prepareDiContainer(['router', 'pizzaRepository']);

        $factory = new HandleVoteFactory();

        $this->assertTrue($factory instanceof HandleVoteFactory);

        /** @var HandleVoteAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof HandleVoteAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );

        $this->assertAttributeEquals(
            $this->pizzaRepository->reveal(),
            'pizzaRepository',
            $action
        );
    }
}
