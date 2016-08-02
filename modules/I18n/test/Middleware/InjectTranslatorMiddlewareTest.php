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
        $translatorHelper->setTranslator($translator)->shouldBeCalled();

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
        $formSubmitHelper->setTranslator($translator)->shouldBeCalled();

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
        $formLabelHelper->setTranslator($translator)->shouldBeCalled();

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
        $formElementErrorsHelper->setTranslator($translator)
            ->shouldBeCalled();

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

        $helperPluginManager->get('translate')
            ->willReturn($translatorHelper)->shouldBeCalled();

        $helperPluginManager->get('formSubmit')
            ->willReturn($formSubmitHelper)->shouldBeCalled();

        $helperPluginManager->get('formLabel')
            ->willReturn($formLabelHelper)->shouldBeCalled();

        $helperPluginManager->get('formElementErrors')
            ->willReturn($formElementErrorsHelper)->shouldBeCalled();

        return $helperPluginManager;
    }
}
