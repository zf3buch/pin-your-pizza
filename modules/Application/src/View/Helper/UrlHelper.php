<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\View\Helper;

use Zend\Expressive\Helper\Exception\MissingRouterException;
use Zend\Expressive\Helper\UrlHelper as ExpressiveUrlHelper;
use Zend\Expressive\Router\Exception\RuntimeException;
use Zend\Expressive\Router\RouteResult;

/**
 * Class UrlHelper
 *
 * @package Application\View\Helper
 */
class UrlHelper extends ExpressiveUrlHelper
{
    /**
     * @var RouteResult
     */
    private $result;

    /**
     * @var string
     */
    private $defaultLang;

    /**
     * @var string
     */
    private $defaultRoute;

    /**
     * Inject a route result.
     *
     * When the route result is injected, the helper will use it to seed default
     * parameters if the URL being generated is for the route that was matched.
     *
     * @param RouteResult $result
     */
    public function setRouteResult(RouteResult $result)
    {
        $this->result = $result;

        parent::setRouteResult($result);
    }

    /**
     * @param mixed $defaultLang
     */
    public function setDefaultLang($defaultLang)
    {
        $this->defaultLang = $defaultLang;
    }

    /**
     * @param string $defaultRoute
     */
    public function setDefaultRoute($defaultRoute)
    {
        $this->defaultRoute = $defaultRoute;
    }

   /**
     * Generate a URL based on a given route.
     *
     * @param string $route
     * @param array  $params
     *
     * @return string
     * @throws RuntimeException if no route provided, and no
     *                                    result match present.
     * @throws RuntimeException if no route provided, and result
     *                                    match is a routing failure.
     * @throws MissingRouterException if router cannot generate URI for given
     *                         route.
     */
    public function __invoke($route = null, array $params = [])
    {
        if (!$route && $this->result->isFailure()) {
            $route = $this->defaultRoute;
        }

        $matchedParams = $this->result->getMatchedParams();

        if (isset($matchedParams['lang'])) {
            $lang = $matchedParams['lang'];
        } else {
            $lang = $this->defaultLang;
        }

        $params = array_merge(['lang' => $lang], $params);

        return parent::__invoke(
            $route, $params
        );
    }

}