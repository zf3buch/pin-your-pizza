<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\ShowPinboardAction;
use Pizza\Action\ShowPinboardFactory;

/**
 * Class ShowPinboardFactoryTest
 *
 * @package PizzaTest\Action
 */
class ShowPinboardFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockTemplate();
        $this->mockPizzaRepository();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(['template', 'pizzaRepository']);

        $factory = new ShowPinboardFactory();

        /** @var ShowPinboardAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof ShowPinboardAction);

        $this->assertAttributeEquals(
            $this->template->reveal(), 'template', $action
        );

        $this->assertAttributeEquals(
            $this->pizzaRepository->reveal(),
            'pizzaRepository',
            $action
        );
    }
}
