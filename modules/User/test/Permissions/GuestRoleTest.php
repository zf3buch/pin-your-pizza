<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Form;

use PHPUnit_Framework_TestCase;
use User\Permissions\GuestRole;

/**
 * Class GuestRoleTest
 *
 * @package UserTest\Form
 */
class GuestRoleTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test role name
     */
    public function testRoleName()
    {
        $role = new GuestRole();

        $this->assertEquals('guest', $role->getName());
    }

    /**
     * Test role permissions
     */
    public function testRolePermissions()
    {
        $role = new GuestRole();

        $this->assertTrue($role->hasPermission('home'));
        $this->assertTrue($role->hasPermission('pizza-pinboard'));
        $this->assertTrue($role->hasPermission('pizza-show'));
        $this->assertFalse($role->hasPermission('pizza-vote'));
        $this->assertFalse($role->hasPermission('pizza-comment'));
        $this->assertFalse($role->hasPermission('pizza-delete-comment'));
        $this->assertTrue($role->hasPermission('user-intro'));
        $this->assertTrue($role->hasPermission('user-handle-login'));
        $this->assertTrue($role->hasPermission('user-handle-register'));
        $this->assertFalse($role->hasPermission('user-handle-logout'));
        $this->assertTrue($role->hasPermission('user-registered'));
    }
}
