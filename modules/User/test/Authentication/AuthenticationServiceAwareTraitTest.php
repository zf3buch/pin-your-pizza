<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Authentication;

use PHPUnit_Framework_TestCase;
use User\Authentication\AuthenticationServiceAwareTrait;
use Zend\Authentication\AuthenticationService;

/**
 * Class AuthenticationServiceAwareTraitTest
 *
 * @package UserTest\Authentication
 */
class AuthenticationServiceAwareTraitTest extends PHPUnit_Framework_TestCase
{
    use AuthenticationServiceAwareTrait;

    /**
     * Test setter from trait
     */
    public function testSetterFromTrait()
    {
        $authService = new AuthenticationService();

        $this->setAuthenticationService($authService);

        $this->assertEquals($authService, $this->authenticationService);
    }
}
