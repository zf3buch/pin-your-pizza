<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest;

use PHPUnit_Framework_TestCase;
use Application\ConfigProvider;

/**
 * Class ConfigProviderTest
 *
 * @package ApplicationTest
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

        $this->assertTrue(defined('APPLICATION_ROOT'));
        $this->assertEquals($this->moduleRoot, realpath(APPLICATION_ROOT));
    }

    /**
     * Test invoking object
     */
    public function testInvoking()
    {
        if (!defined('PROJECT_ROOT')) {
            define('PROJECT_ROOT', __DIR__ . '/../../../');
        }

        $expectedConfig = include $this->moduleRoot . '/config/module.config.php';

        $configProvider = new ConfigProvider();
        $configData = $configProvider();

        $this->assertEquals($expectedConfig, $configData);
    }
}
