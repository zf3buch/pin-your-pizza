<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\Action;

use I18n\Middleware\InjectTranslatorMiddleware;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Form\View\Helper\FormElementErrors;
use Zend\Form\View\Helper\FormLabel;
use Zend\Form\View\Helper\FormSubmit;
use Zend\I18n\Translator\Translator;
use Zend\I18n\View\Helper\Translate;
use Zend\View\HelperPluginManager;

/**
 * Class InjectTranslatorMiddlewareTest
 *
 * @package I18nTest\Action
 */
class InjectTranslatorMiddlewareTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup test cases
     */
    public function setUp()
    {
    }

    /**
     * Test translator injection
     */
    public function testTranslatorInjection()
    {
        /** @var Translator $translator */
        $translator = $this->prophesize(Translator::class);

        $translatorHelper = $this->prepareTranslatorHelper($translator);

        $formSubmitHelper = $this->prepareFormSubmitHelper($translator);

        $formLabelHelper = $this->prepareFormLabelHelper($translator);

        $formElementErrorsHelper = $this->prepareFormElementErrors(
            $translator
        );

        $helperPluginManager = $this->prepareHelperPluginManager(
            $translatorHelper,
            $formSubmitHelper,
            $formLabelHelper,
            $formElementErrorsHelper
        );

        $middleware = new InjectTranslatorMiddleware(
            $translator->reveal(), $helperPluginManager->reveal()
        );

        $serverRequest = new ServerRequest();

        $serverResponse = new Response();

        $next = function ($serverRequest, $serverResponse) {
            return md5(
                serialize($serverRequest) . serialize($serverResponse)
            );
        };

        /** @var RedirectResponse $response */
        $response = $middleware($serverRequest, $serverResponse, $next);

        $this->assertEquals(
            $next($serverRequest, $serverResponse), $response
        );
    }

    /**
     * @param $translator
     *
     * @return array
     */
    protected function prepareTranslatorHelper($translator)
    {
        /** @var Translate $translatorHelper */
        $translatorHelper = $this->prophesize(Translate::class);

        /** @var MethodProphecy $method */
        $method = $translatorHelper->setTranslator($translator);
        $method->shouldBeCalled();

        return $translatorHelper;
    }

    /**
     * @param $translator
     *
     * @return array
     */
    protected function prepareFormSubmitHelper($translator)
    {
        /** @var FormSubmit $formSubmitHelper */
        $formSubmitHelper = $this->prophesize(FormSubmit::class);

        /** @var MethodProphecy $method */
        $method = $formSubmitHelper->setTranslator($translator);
        $method->shouldBeCalled();

        return $formSubmitHelper;
    }

    /**
     * @param $translator
     *
     * @return array
     */
    protected function prepareFormLabelHelper($translator)
    {
        /** @var FormLabel $formLabelHelper */
        $formLabelHelper = $this->prophesize(FormLabel::class);

        /** @var MethodProphecy $method */
        $method = $formLabelHelper->setTranslator($translator);
        $method->shouldBeCalled();

        return $formLabelHelper;
    }

    /**
     * @param $translator
     *
     * @return array
     */
    protected function prepareFormElementErrors($translator)
    {
        /** @var FormElementErrors $formElementErrorsHelper */
        $formElementErrorsHelper = $this->prophesize(
            FormElementErrors::class
        );

        /** @var MethodProphecy $method */
        $method = $formElementErrorsHelper->setTranslator($translator);
        $method->shouldBeCalled();

        return $formElementErrorsHelper;
    }

    /**
     * @param $translatorHelper
     * @param $formSubmitHelper
     * @param $formLabelHelper
     * @param $formElementErrorsHelper
     *
     * @return HelperPluginManager
     */
    protected function prepareHelperPluginManager(
        $translatorHelper,
        $formSubmitHelper,
        $formLabelHelper,
        $formElementErrorsHelper
    ) {
        /** @var HelperPluginManager $helperPluginManager */
        $helperPluginManager = $this->prophesize(
            HelperPluginManager::class
        );

        /** @var MethodProphecy $method */
        $method = $helperPluginManager->get('translate');
        $method->willReturn($translatorHelper);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $helperPluginManager->get('formSubmit');
        $method->willReturn($formSubmitHelper);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $helperPluginManager->get('formLabel');
        $method->willReturn($formLabelHelper);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $helperPluginManager->get('formElementErrors');
        $method->willReturn($formElementErrorsHelper);
        $method->shouldBeCalled();

        return $helperPluginManager;
    }
}
