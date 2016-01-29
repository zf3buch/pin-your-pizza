<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n\Middleware;

use Locale;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\RouteResult;

/**
 * Class LocalizationMiddleware
 *
 * @package Application\I18n\Middleware
 */
class LocalizationMiddleware
{
    /**
     * @var string
     */
    private $defaultLang;

    /**
     * @var array
     */
    private $allowedLocales;

    /**
     * @param string $defaultLang
     */
    public function setDefaultLang($defaultLang)
    {
        $this->defaultLang = $defaultLang;
    }

    /**
     * @param array $allowedLocales
     */
    public function setAllowedLocales($allowedLocales)
    {
        $this->allowedLocales = $allowedLocales;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return callable|null
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $result = $request->getAttribute(RouteResult::class, false);

        if ($result === false || $result->isFailure()) {
            $lang = $this->defaultLang;
        } else {
            $matchedParams = $result->getMatchedParams();

            $lang = $matchedParams['lang'] ?: $this->defaultLang;
        }

        $locale = $this->allowedLocales[$lang];

        Locale::setDefault($locale);

        return $next($request, $response);
    }
}
