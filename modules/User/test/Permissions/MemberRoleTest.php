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
use User\Permissions\MemberRole;

/**
 * Class MemberRoleTest
 *
 * @package UserTest\Form
 */
class MemberRoleTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test role name
     */
    public function testRoleName()
    {
        $role = new MemberRole();

        $this->assertEquals('member', $role->getName());
    }

    /**
     * Test role permissions
     */
    public function testRolePermissions()
    {
        $role = new MemberRole();

        $this->assertTrue($role->hasPermission('home'));
        $this->assertTrue($role->hasPermission('pizza-pinboard'));
        $this->assertTrue($role->hasPermission('pizza-show'));
        $this->assertTrue($role->hasPermission('pizza-vote'));
        $this->assertTrue($role->hasPermission('pizza-comment'));
        $this->assertFalse($role->hasPermission('pizza-delete-comment'));
        $this->assertFalse($role->hasPermission('user-intro'));
        $this->assertFalse($role->hasPermission('user-handle-login'));
        $this->assertFalse($role->hasPermission('user-handle-register'));
        $this->assertTrue($role->hasPermission('user-handle-logout'));
        $this->assertFalse($role->hasPermission('user-registered'));
    }
}
