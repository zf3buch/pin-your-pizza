<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18nTest\Action;

use I18n\Middleware\LocalizationFactory;
use I18n\Middleware\LocalizationMiddleware;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Diactoros\Response;
use Zend\I18n\Translator\Translator;

/**
 * Class LocalizationFactoryTest
 *
 * @package I18nTest\Action
 */
class LocalizationFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->translator = $this->prophesize(Translator::class);
    }

    /**
     * Test translator injection
     */
    public function testTranslatorInjection()
    {
        $config = [
            'i18n' => [
                'defaultLang'    => 'de',
                'allowedLocales' => [
                    'de' => 'de_DE',
                    'en' => 'en_US',
                ],
                'defaultRoute'   => 'home',
            ]
        ];

        /** @var MethodProphecy $method */
        $method = $this->container->get('config');
        $method->willReturn($config);
        $method->shouldBeCalled();

        /** @var MethodProphecy $method */
        $method = $this->container->get(Translator::class);
        $method->willReturn($this->translator);
        $method->shouldBeCalled();

        $factory = new LocalizationFactory();

        $this->assertTrue($factory instanceof LocalizationFactory);

        /** @var LocalizationMiddleware $middleware */
        $middleware = $factory($this->container->reveal());

        $this->assertTrue($middleware instanceof LocalizationMiddleware);

        $this->assertAttributeEquals(
            $this->translator->reveal(), 'translator', $middleware
        );
    }
}
