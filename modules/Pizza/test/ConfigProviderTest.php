<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest;

use PHPUnit_Framework_TestCase;
use Pizza\ConfigProvider;

/**
 * Class ConfigProviderTest
 *
 * @package PizzaTest
 */
class ConfigProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $moduleRoot = null;

    /**
     * Setup test cases
     */
    public function setUp()
    {
        $this->moduleRoot = realpath(__DIR__ . '/../');
    }

    /**
     * Test constant after instantiation
     */
    public function testConstant()
    {
        $this->assertTrue(class_exists(ConfigProvider::class));

        $this->assertTrue(defined('PIZZA_ROOT'));
        $this->assertEquals($this->moduleRoot, realpath(PIZZA_ROOT));
    }

    /**
     * Test invoking object
     */
    public function testInvoking()
    {
        $expectedConfig = include $this->moduleRoot . '/config/module.config.php';

        $configProvider = new ConfigProvider();
        $configData = $configProvider();

        $this->assertEquals($expectedConfig, $configData);
    }
}
