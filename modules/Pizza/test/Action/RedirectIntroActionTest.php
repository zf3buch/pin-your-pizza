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
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class RedirectIntroActionTest
 *
 * @package PizzaTest\Action
 */
class RedirectIntroActionTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang        = 'de';
        $uri         = '/de';
        $routeParams = [
            'lang' => $lang,
        ];
        $routeName   = 'home';
        $requestUri  = '/';

        $this->prepareRouter($routeName, $routeParams, $uri);

        $action = new RedirectIntroAction();
        $action->setRouter($this->router->reveal());

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);

        $serverResponse = new Response();

        /** @var RedirectResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
