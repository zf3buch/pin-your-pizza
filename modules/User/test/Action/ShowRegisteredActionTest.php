<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Action;

use User\Action\ShowRegisteredAction;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class ShowRegisteredActionTest
 *
 * @package UserTest\Action
 */
class ShowRegisteredActionTest extends AbstractTest
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->mockTemplate();
        $this->mockLoginForm();
    }

    /**
     * Test Response object
     */
    public function testResponse()
    {
        $lang         = 'de';
        $templateVars = [
            'loginForm' => $this->loginForm,
        ];
        $templateName = 'user::registered';
        $requestUri   = '/' . $lang . '/user';

        $this->prepareRenderer($templateName, $templateVars);

        $action = new ShowRegisteredAction();
        $action->setTemplateRenderer($this->template->reveal());
        $action->setLoginForm($this->loginForm->reveal());

        $serverRequest = new ServerRequest([$requestUri]);

        $serverResponse = new Response();

        /** @var HtmlResponse $response */
        $response = $action($serverRequest, $serverResponse);

        $this->assertTrue($response instanceof HtmlResponse);
    }
}
