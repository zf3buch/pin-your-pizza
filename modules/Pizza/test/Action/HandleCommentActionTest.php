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
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HandleCommentActionTest
 *
 * @package PizzaTest\Action
 */
class HandleCommentActionTest extends AbstractTest
{
    /**
     * Prepare comment form
     *
     * @param array      $setData
     * @param array|bool $getData
     * @param bool       $isValidReturn
     */
    protected function prepareCommentForm(
        $setData,
        $getData,
        $isValidReturn = true
    ) {
        /** @var MethodProphecy $method */
        $method = $this->commentForm->setData($setData);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->commentForm->getData();

        if ($getData) {
            $method->willReturn($getData);
            $method->shouldBeCalled();
        } else {
            $method->shouldNotBeCalled();
        }

        /** @var MethodProphecy $method */
        $method = $this->commentForm->isValid();
        $method->willReturn($isValidReturn);
        $method->shouldBeCalled();
    }

    /**
     * Prepare comment repository
     *
     * @param string $id
     * @param array  $postData
     * @param bool   $called
     */
    protected function prepareCommentRepository(
        $id,
        $postData,
        $called = true
    ) {
        /** @var MethodProphecy $method */
        $method = $this->commentRepository->saveComment(
            $id, $postData
        );

        if ($called) {
            $method->shouldBeCalled();
        }
    }

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRouter();
        $this->mockCommentRepository();
        $this->mockCommentForm();
    }

    /**
     * Test Response object
     */
    public function testResponseWithValidData()
    {
        $lang        = 'de';
        $id          = 1;
        $uri         = '/' . $lang . '/pizza/show/' . $id;
        $routeParams = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $routeName   = 'pizza-show';
        $requestUri  = '/';
        $postData    = [
            'name'         => 'Name',
            'text'         => 'text',
            'save_comment' => 'save_comment',
        ];

        $this->prepareRouter($routeName, $routeParams, $uri);
        $this->prepareCommentForm($postData, $postData, true);
        $this->prepareCommentRepository($id, $postData);

        $action = new HandleCommentAction();
        $action->setRouter($this->router->reveal());
        $action->setCommentRepository(
            $this->commentRepository->reveal()
        );
        $action->setCommentForm(
            $this->commentForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('id', $id);

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, new Response()
        );

        $this->assertTrue($response instanceof RedirectResponse);
        $this->assertEquals([$uri], $response->getHeader('location'));
    }

    /**
     * Test Response object
     */
    public function testResponseWithInvalidData()
    {
        $lang        = 'de';
        $id          = 1;
        $uri         = '/' . $lang . '/pizza/show/' . $id;
        $routeParams = [
            'id'   => $id,
            'lang' => $lang,
        ];
        $routeName   = 'pizza-show';
        $postData    = [
            'name'         => 'Name',
            'text'         => 'text',
            'save_comment' => 'save_comment',
        ];
        $requestUri  = '/' . $lang . '/pizza/comment/' . $id;

        $this->prepareRouter($routeName, $routeParams, $uri, false);
        $this->prepareCommentForm($postData, false, false);
        $this->prepareCommentRepository($id, $postData, false);

        /** @var MethodProphecy $method */
        $method = $this->commentForm->getData();
        $method->shouldNotBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->commentForm->isValid();
        $method->willReturn(false);
        $method->shouldBeCalled();

        $action = new HandleCommentAction();
        $action->setRouter($this->router->reveal());
        $action->setCommentRepository(
            $this->commentRepository->reveal()
        );
        $action->setCommentForm(
            $this->commentForm->reveal()
        );

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withParsedBody($postData);
        $serverRequest = $serverRequest->withAttribute('lang', $lang);
        $serverRequest = $serverRequest->withAttribute('id', $id);

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $action(
            $serverRequest, $serverResponse, $next
        );

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }
}
