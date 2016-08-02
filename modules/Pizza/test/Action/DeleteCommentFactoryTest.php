<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Action;

use Pizza\Action\DeleteCommentAction;
use Pizza\Action\DeleteCommentFactory;

/**
 * Class DeleteCommentFactoryTest
 *
 * @package PizzaTest\Action
 */
class DeleteCommentFactoryTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockCommentRepository();
        $this->mockDiContainer();
    }

    /**
     * Test factory with all dependencies
     */
    public function testFactoryWithAllDependencies()
    {
        $this->prepareDiContainer(['router', 'commentRepository']);

        $factory = new DeleteCommentFactory();

        /** @var DeleteCommentAction $action */
        $action = $factory($this->container->reveal());

        $this->assertTrue($action instanceof DeleteCommentAction);

        $this->assertAttributeEquals(
            $this->router->reveal(), 'router', $action
        );

        $this->assertAttributeEquals(
            $this->commentRepository->reveal(),
            'commentRepository',
            $action
        );
    }
}
