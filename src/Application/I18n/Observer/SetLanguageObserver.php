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
     * SetLanguageObserver constructor.
     *
     * @param string     $defaultLang
     * @param array      $allowedLocales
     */
    public function __construct(
        $defaultLang, array $allowedLocales = []
    ) {
        $this->default    = $defaultLang;
        $this->locales    = $allowedLocales;
    }

    /**
     * @param RouteResult $result
     */
    public function update(RouteResult $result)
    {
        if ($result->isFailure()) {
            return;
        }

        $matchedParams = $result->getMatchedParams();

        $lang   = $matchedParams['lang'] ?: $this->default;
        $locale = $this->locales[$lang];

        Locale::setDefault($locale);
    }
}
