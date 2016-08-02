<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\ShowPizzaAction;
use Pizza\Action\ShowPizzaFactory;

/**
 * Class ShowPizzaFactoryTest
 *
 * @package PizzaTest\Action
 */
class ShowPizzaFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockTemplate();
        $this->mockPizzaRepository();
        $this->mockCommentForm();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(
            ['template', 'pizzaRepository', 'commentForm']
        );

        $factory = new ShowPizzaFactory();

        /** @var ShowPizzaAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof ShowPizzaAction);

        $this->assertAttributeEquals(
            $this->template->reveal(), 'template', $action
        );

        $this->assertAttributeEquals(
            $this->pizzaRepository->reveal(),
            'pizzaRepository',
            $action
        );

        $this->assertAttributeEquals(
            $this->commentForm->reveal(),
            'commentForm',
            $action
        );
    }
}
