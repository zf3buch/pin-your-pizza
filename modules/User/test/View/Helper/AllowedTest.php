<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\View\Helper;

use PHPUnit_Framework_TestCase;
use User\Permissions\Rbac;
use User\View\Helper\Allowed;

/**
 * Class AllowedTest
 *
 * @package UserTest\View\Helper
 */
class AllowedTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test guest permissions
     */
    public function testGuestPermissions()
    {
        $role = 'guest';
        $rbac = new Rbac();

        $viewHelper = new Allowed($role, $rbac);

        $this->assertTrue($viewHelper('home'));
        $this->assertTrue($viewHelper('pizza-pinboard'));
        $this->assertTrue($viewHelper('pizza-show'));
        $this->assertFalse($viewHelper('pizza-vote'));
        $this->assertFalse($viewHelper('pizza-comment'));
        $this->assertFalse($viewHelper('pizza-delete-comment'));
        $this->assertTrue($viewHelper('user-intro'));
        $this->assertTrue($viewHelper('user-handle-login'));
        $this->assertTrue($viewHelper('user-handle-register'));
        $this->assertFalse($viewHelper('user-handle-logout'));
        $this->assertTrue($viewHelper('user-registered'));
    }

    /**
     * Test member permissions
     */
    public function testMemberPermissions()
    {
        $role = 'member';
        $rbac = new Rbac();

        $viewHelper = new Allowed($role, $rbac);

        $this->assertTrue($viewHelper('home'));
        $this->assertTrue($viewHelper('pizza-pinboard'));
        $this->assertTrue($viewHelper('pizza-show'));
        $this->assertTrue($viewHelper('pizza-vote'));
        $this->assertTrue($viewHelper('pizza-comment'));
        $this->assertFalse($viewHelper('pizza-delete-comment'));
        $this->assertFalse($viewHelper('user-intro'));
        $this->assertFalse($viewHelper('user-handle-login'));
        $this->assertFalse($viewHelper('user-handle-register'));
        $this->assertTrue($viewHelper('user-handle-logout'));
        $this->assertFalse($viewHelper('user-registered'));
    }

    /**
     * Test admin permissions
     */
    public function testAdminPermissions()
    {
        $role = 'admin';
        $rbac = new Rbac();

        $viewHelper = new Allowed($role, $rbac);

        $this->assertTrue($viewHelper('home'));
        $this->assertTrue($viewHelper('pizza-pinboard'));
        $this->assertTrue($viewHelper('pizza-show'));
        $this->assertTrue($viewHelper('pizza-vote'));
        $this->assertTrue($viewHelper('pizza-comment'));
        $this->assertTrue($viewHelper('pizza-delete-comment'));
        $this->assertFalse($viewHelper('user-intro'));
        $this->assertFalse($viewHelper('user-handle-login'));
        $this->assertFalse($viewHelper('user-handle-register'));
        $this->assertTrue($viewHelper('user-handle-logout'));
        $this->assertFalse($viewHelper('user-registered'));
    }
}
