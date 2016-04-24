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
use User\View\Helper\Identity;

/**
 * Class IdentityTest
 *
 * @package UserTest\View\Helper
 */
class IdentityTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test identity return
     */
    public function testIdentityReturn()
    {
        $role = 'guest';

        $identity = (object)['role' => $role];

        $viewHelper = new Identity($identity);

        $this->assertEquals($identity, $viewHelper());
    }
}
