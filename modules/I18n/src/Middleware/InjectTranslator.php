<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\I18n\Translator\Translator;
use Zend\Validator\AbstractValidator;
use Zend\View\HelperPluginManager;

/**
 * Class InjectTranslator
 *
 * @package I18n\Middleware
 */
class InjectTranslator
{
    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var HelperPluginManager
     */
    private $helperPluginManager;

    /**
     * InjectTranslator constructor.
     *
     * @param Translator          $translator
     * @param HelperPluginManager $helperPluginManager
     */
    public function __construct(
        Translator $translator,
        HelperPluginManager $helperPluginManager
    ) {
        $this->translator          = $translator;
        $this->helperPluginManager = $helperPluginManager;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return RedirectResponse|callable|null
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $translateHelper = $this->helperPluginManager->get('translate');
        $translateHelper->setTranslator($this->translator);

        $formSubmitHelper = $this->helperPluginManager->get('formSubmit');
        $formSubmitHelper->setTranslator($this->translator);

        $formLabelHelper = $this->helperPluginManager->get('formLabel');
        $formLabelHelper->setTranslator($this->translator);

        AbstractValidator::setDefaultTranslator($this->translator);

        return $next($request, $response);
    }
}
