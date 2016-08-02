<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\HandleCommentAction;
use Pizza\Action\HandleCommentFactory;

/**
 * Class HandleCommentFactoryTest
 *
 * @package PizzaTest\Action
 */
class HandleCommentFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockCommentRepository();
        $this->mockCommentForm();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(
            ['router', 'commentRepository', 'commentForm']
        );

        $factory = new HandleCommentFactory();

        /** @var HandleCommentAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof HandleCommentAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );

        $this->assertAttributeEquals(
            $this->commentRepository->reveal(),
            'commentRepository',
            $action
        );

        $this->assertAttributeEquals(
            $this->commentForm->reveal(),
            'commentForm',
            $action
        );
    }
}
