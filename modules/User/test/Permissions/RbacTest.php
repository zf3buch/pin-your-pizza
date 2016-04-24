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
use User\Permissions\Rbac;

/**
 * Class RbacTest
 *
 * @package UserTest\Form
 */
class RbacTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test guest permissions
     */
    public function testGuestPermissions()
    {
        $rbac = new Rbac();

        $this->assertTrue($rbac->isGranted('guest', 'home'));
        $this->assertTrue($rbac->isGranted('guest', 'pizza-pinboard'));
        $this->assertTrue($rbac->isGranted('guest', 'pizza-show'));
        $this->assertFalse($rbac->isGranted('guest', 'pizza-vote'));
        $this->assertFalse($rbac->isGranted('guest', 'pizza-comment'));
        $this->assertFalse($rbac->isGranted('guest', 'pizza-delete-comment'));
        $this->assertTrue($rbac->isGranted('guest', 'user-intro'));
        $this->assertTrue($rbac->isGranted('guest', 'user-handle-login'));
        $this->assertTrue($rbac->isGranted('guest', 'user-handle-register'));
        $this->assertFalse($rbac->isGranted('guest', 'user-handle-logout'));
        $this->assertTrue($rbac->isGranted('guest', 'user-registered'));
    }

    /**
     * Test member permissions
     */
    public function testMemberPermissions()
    {
        $rbac = new Rbac();

        $this->assertTrue($rbac->isGranted('member', 'home'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-pinboard'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-show'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-vote'));
        $this->assertTrue($rbac->isGranted('member', 'pizza-comment'));
        $this->assertFalse($rbac->isGranted('member', 'pizza-delete-comment'));
        $this->assertFalse($rbac->isGranted('member', 'user-intro'));
        $this->assertFalse($rbac->isGranted('member', 'user-handle-login'));
        $this->assertFalse($rbac->isGranted('member', 'user-handle-register'));
        $this->assertTrue($rbac->isGranted('member', 'user-handle-logout'));
        $this->assertFalse($rbac->isGranted('member', 'user-registered'));
    }

    /**
     * Test admin permissions
     */
    public function testAdminPermissions()
    {
        $rbac = new Rbac();

        $this->assertTrue($rbac->isGranted('admin', 'home'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-pinboard'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-show'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-vote'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-comment'));
        $this->assertTrue($rbac->isGranted('admin', 'pizza-delete-comment'));
        $this->assertFalse($rbac->isGranted('admin', 'user-intro'));
        $this->assertFalse($rbac->isGranted('admin', 'user-handle-login'));
        $this->assertFalse($rbac->isGranted('admin', 'user-handle-register'));
        $this->assertTrue($rbac->isGranted('admin', 'user-handle-logout'));
        $this->assertFalse($rbac->isGranted('admin', 'user-registered'));
    }
}
