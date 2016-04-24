<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace ApplicationTest\Router;

use Application\Router\RouterAwareTrait;
use PHPUnit_Framework_TestCase;
use Zend\Expressive\Router\ZendRouter;

/**
 * Class RouterAwareTraitTest
 *
 * @package ApplicationTest\Router
 */
class RouterAwareTraitTest extends PHPUnit_Framework_TestCase
{
    use RouterAwareTrait;

    /**
     * Test setter from trait
     */
    public function testSetterFromTrait()
    {
        $router = new ZendRouter();

        $this->setRouter($router);

        $this->assertEquals($router, $this->router);
    }
}
