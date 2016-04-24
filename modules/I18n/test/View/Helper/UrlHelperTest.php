<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\View\Helper;

use I18n\View\Helper\UrlHelper;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class UrlHelperTest
 *
 * @package I18nTest\View\Helper
 */
class UrlHelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $config
        = [
            'i18n' => [
                'defaultLang'    => 'de',
                'allowedLocales' => [
                    'de' => 'de_DE',
                    'en' => 'en_US',
                ],
                'defaultRoute'   => 'home',
            ],
        ];

    /**
     * Test with no route and no route result
     */
    public function testNoRouteNoResult()
    {
        $expectedUrl = '/';

        $routeName   = 'home';
        $routeParams = [
            'lang' => 'de',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);

        /** @var MethodProphecy $method */
        $method = $router->generateUri($routeName, $routeParams);
        $method->willReturn($expectedUrl);
        $method->shouldBeCalled();

        $viewHelper = new UrlHelper($router->reveal());
        $viewHelper->setDefaultLang($this->config['i18n']['defaultLang']);
        $viewHelper->setDefaultRoute($this->config['i18n']['defaultRoute']);

        $this->assertEquals($expectedUrl, $viewHelper());
    }

    /**
     * Test with no route and no failed result
     */
    public function testNoRouteFailedResult()
    {
        $expectedUrl = '/';

        $routeName   = 'home';
        $routeParams = [
            'lang' => 'de',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);

        /** @var MethodProphecy $method */
        $method = $router->generateUri($routeName, $routeParams);
        $method->willReturn($expectedUrl);
        $method->shouldBeCalled();

        $routeResult = RouteResult::fromRouteFailure();

        $viewHelper = new UrlHelper($router->reveal());
        $viewHelper->setDefaultLang($this->config['i18n']['defaultLang']);
        $viewHelper->setDefaultRoute($this->config['i18n']['defaultRoute']);
        $viewHelper->setRouteResult($routeResult);

        $this->assertEquals($expectedUrl, $viewHelper());
    }

    /**
     * Test with route and no route result
     */
    public function testWithRouteNoResult()
    {
        $expectedUrl = '/';

        $routeName   = 'some-route';
        $routeParams = [
            'lang' => 'de',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);

        /** @var MethodProphecy $method */
        $method = $router->generateUri($routeName, $routeParams);
        $method->willReturn($expectedUrl);
        $method->shouldBeCalled();

        $viewHelper = new UrlHelper($router->reveal());
        $viewHelper->setDefaultLang($this->config['i18n']['defaultLang']);
        $viewHelper->setDefaultRoute($this->config['i18n']['defaultRoute']);

        $this->assertEquals($expectedUrl, $viewHelper($routeName));
    }

    /**
     * Test with route and matched route result
     */
    public function testWithRouteMatchedResult()
    {
        $expectedUrl = '/';

        $routeName   = 'some-route';
        $routeParams = [
            'lang' => 'en',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);

        /** @var MethodProphecy $method */
        $method = $router->generateUri($routeName, $routeParams);
        $method->willReturn($expectedUrl);
        $method->shouldBeCalled();

        $routeResult = RouteResult::fromRouteMatch(
            $routeName,
            'function',
            $routeParams
        );

        $viewHelper = new UrlHelper($router->reveal());
        $viewHelper->setDefaultLang($this->config['i18n']['defaultLang']);
        $viewHelper->setDefaultRoute($this->config['i18n']['defaultRoute']);
        $viewHelper->setRouteResult($routeResult);

        $this->assertEquals($expectedUrl, $viewHelper($routeName));
    }

    /**
     * Test with route and matched route result
     */
    public function testWithRouteMatchedResultAndParams()
    {
        $expectedUrl = '/';

        $routeName    = 'some-route';
        $passedParams = [
            'controller' => 'some-controller',
        ];
        $usedParams   = [
            'controller' => 'some-controller',
            'lang'       => 'de',
        ];

        /** @var RouterInterface $router */
        $router = $this->prophesize(RouterInterface::class);

        /** @var MethodProphecy $method */
        $method = $router->generateUri($routeName, $usedParams);
        $method->willReturn($expectedUrl);
        $method->shouldBeCalled();

        $routeResult = RouteResult::fromRouteMatch(
            $routeName,
            'function',
            $passedParams
        );

        $viewHelper = new UrlHelper($router->reveal());
        $viewHelper->setDefaultLang($this->config['i18n']['defaultLang']);
        $viewHelper->setDefaultRoute($this->config['i18n']['defaultRoute']);
        $viewHelper->setRouteResult($routeResult);

        $this->assertEquals(
            $expectedUrl, $viewHelper($routeName, $passedParams)
        );
    }

}
