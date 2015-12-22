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
     * {@inheritDoc}
     */
    public function update(RouteResult $result)
    {
        $this->result = $result;

        parent::update($result);
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
        $matchedParams = $this->result->getMatchedParams();

        if (isset($matchedParams['lang'])) {
            $params = array_merge(['lang' => $matchedParams['lang']], $params);
        }

        return parent::__invoke(
            $route, $params
        );
    }

}