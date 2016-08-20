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
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class ShowPinboardActionTest
 *
 * @package PizzaTest\Action
 */
class ShowPinboardActionTest extends AbstractTest
{
    /**
     * Prepare pizza repository
     *
     * @param $pizzaPinboard
     */
    protected function preparePizzaRepository($pizzaPinboard)
    {
        $this->pizzaRepository->getPizzaPinboard()
            ->willReturn($pizzaPinboard)->shouldBeCalled();
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRenderer();
        $this->mockPizzaRepository();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang          = 'de';
        $pizzaPinboard = ['1' => 'Pizza A', '2' => 'Pizza B'];
        $templateVars  = [
            'welcome'   => 'pizza_heading_welcome',
            'pizzaList' => $pizzaPinboard,
        ];
        $templateName  = 'pizza::pinboard';
        $requestUri    = '/' . $lang;

        $this->prepareRenderer($templateName, $templateVars);
        $this->preparePizzaRepository($pizzaPinboard);

        $action = new ShowPinboardAction();
        $action->setTemplateRenderer($this->renderer->reveal());
        $action->setPizzaRepository($this->pizzaRepository->reveal());

        $serverRequest = new ServerRequest([$requestUri]);

        $serverResponse = new Response();

        /** @var HtmlResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
