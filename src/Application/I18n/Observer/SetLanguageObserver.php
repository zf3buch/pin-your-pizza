<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n\Observer;

use Locale;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Router\RouteResultObserverInterface;
use Zend\I18n\Translator\Translator;

/**
 * Class SetLanguageObserver
 *
 * @package Application\I18n\Observer
 */
class SetLanguageObserver implements RouteResultObserverInterface
{
    /**
     * @var string
     */
    private $default = null;

    /**
     * @var array
     */
    private $locales = [];

    /**
     * @var Translator
     */
    private $translator;

    /**
     * SetLanguageObserver constructor.
     *
     * @param string     $defaultLang
     * @param array      $allowedLocales
     * @param Translator $translator
     */
    public function __construct(
        $defaultLang, array $allowedLocales = [], Translator $translator
    ) {
        $this->default    = $defaultLang;
        $this->locales    = $allowedLocales;
        $this->translator = $translator;
    }

    /**
     * @param RouteResult $result
     */
    public function update(RouteResult $result)
    {
        if ($result->isFailure()) {
            $lang = $this->default;
        } else {
            $matchedParams = $result->getMatchedParams();

            $lang = $matchedParams['lang'] ?: $this->default;
        }

        $locale = $this->locales[$lang];

        Locale::setDefault($locale);

        $this->translator->setLocale($locale);
    }
}
