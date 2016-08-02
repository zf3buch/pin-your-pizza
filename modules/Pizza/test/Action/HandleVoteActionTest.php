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
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HandleVoteActionTest
 *
 * @package PizzaTest\Action
 */
class HandleVoteActionTest extends AbstractTest
{
    /**
     * Prepare pizza repository
     *
     * @param $id
     * @param $star
     */
    protected function preparePizzaRepository($id, $star)
    {
        $this->pizzaRepository->saveVoting($id, $star)->shouldBeCalled();
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockPizzaRepository();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang        = 'de';
        $id          = 1;
        $star        = 4;
        $uri         = '/' . $lang . '/pizza/' . $id;
        $routeParams = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $routeName   = 'pizza-show';
        $queryParams = [
            'star' => $star,
        ];
        $requestUri  = '/' . $lang . '/pizza/' . $id;

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->preparePizzaRepository($id, $star);

        $action = new HandleVoteAction();
        $action->setRouter($this->router->reveal());
        $action->setPizzaRepository(
            $this->pizzaRepository->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('id', $id);
        $serverRequest = $serverRequest->withQueryParams($queryParams);

        $serverResponse = new Response();

        /** @var RedirectResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
