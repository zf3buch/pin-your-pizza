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
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class DeleteCommentActionTest
 *
 * @package PizzaTest\Action
 */
class DeleteCommentActionTest extends AbstractTest
{
    /**
     * Prepare comment repository
     *
     * @param $commentId
     */
    protected function prepareCommentRepository($commentId)
    {
        /** @var MethodProphecy $deleteMethod */
        $deleteMethod = $this->commentRepository->deleteComment(
            $commentId
        );
        $deleteMethod->shouldBeCalled();
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockCommentRepository();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang        = 'de';
        $id          = 1;
        $commentId   = 2;
        $uri         = '/' . $lang . '/pizza/' . $id;
        $routeParams = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $routeName   = 'pizza-show';
        $requestUri  = '/' . $lang . '/pizza/' . $id
            . '/delete-comment/' . $commentId;

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->prepareCommentRepository($commentId);

        $action = new DeleteCommentAction();
        $action->setRouter($this->router->reveal());
        $action->setCommentRepository(
            $this->commentRepository->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('id', $id);
        $serverRequest = $serverRequest->withAttribute(
            'commentId', $commentId
        );

        $serverResponse = new Response();

        /** @var RedirectResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }
}
