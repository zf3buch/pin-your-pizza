<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use Prophecy\Prophecy\MethodProphecy;
use User\Action\ShowIntroAction;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class ShowIntroActionTest
 *
 * @package UserTest\Action
 */
class ShowIntroActionTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockRenderer();
        $this->mockLoginForm();
        $this->mockRegisterForm();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang         = 'de';
        $authError    = 'Authentication failed';
        $templateVars = [
            'loginForm'    => $this->loginForm,
            'registerForm' => $this->registerForm,
            'authError'    => $authError,
        ];
        $templateName = 'user::intro';
        $requestUri   = '/' . $lang . '/user';

        $this->prepareRenderer($templateName, $templateVars);

        $action = new ShowIntroAction();
        $action->setTemplateRenderer($this->renderer->reveal());
        $action->setLoginForm($this->loginForm->reveal());
        $action->setRegisterForm($this->registerForm->reveal());

        $serverRequest = new ServerRequest([$requestUri]);
        $serverRequest = $serverRequest->withAttribute(
            'auth_error', $authError
        );

        $serverResponse = new Response();

        /** @var HtmlResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
