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
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class ShowPizzaActionTest
 *
 * @package PizzaTest\Action
 */
class ShowPizzaActionTest extends AbstractTest
{
    /**
     * Prepare pizza repository
     *
     * @param $id
     * @param $pizza
     */
    protected function preparePizzaRepository($id, $pizza)
    {
        /** @var MethodProphecy $method */
        $method = $this->pizzaRepository->getSinglePizza($id);
        $method->willReturn($pizza);
        $method->shouldBeCalled();
    }

    /**
     * Sets up the test
     */
    public function setUp()
    {
        $this->mockTemplate();
        $this->mockPizzaRepository();
        $this->mockCommentForm();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang         = 'de';
        $id           = '1';
        $pizza        = [$id => 'Pizza A'];
        $templateVars = [
            'pizza'               => $pizza,
            'commentForm' => $this->commentForm,
        ];
        $templateName = 'pizza::show';
        $requestUri   = '/' . $lang . '/pizza/show/' . $id;

        $this->prepareRenderer($templateName, $templateVars);
        $this->preparePizzaRepository($id, $pizza);

        $action = new ShowPizzaAction();
        $action->setTemplateRenderer($this->template->reveal());
        $action->setPizzaRepository($this->pizzaRepository->reveal());
        $action->setCommentForm(
            $this->commentForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute('id', $id);

        $serverResponse = new Response();

        /** @var HtmlResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
