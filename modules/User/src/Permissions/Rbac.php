<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Permissions;

use Zend\Permissions\Rbac\Rbac as ZendRbac;

/**
 * Class Rbac
 *
 * @package User\Permissions
 */
class Rbac extends ZendRbac
{
    public function __construct()
    {
        $this->addRole(new GuestRole());
        $this->addRole(new MemberRole());
        $this->addRole(new AdminRole());
    }
}
