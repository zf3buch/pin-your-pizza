<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Permissions;

use Zend\Permissions\Rbac\AbstractRole;

/**
 * Class GuestRole
 *
 * @package User\Permissions
 */
class GuestRole extends AbstractRole
{
    /**
     * @var string
     */
    protected $name = 'guest';

    /**
     * GuestRole constructor.
     */
    public function __construct()
    {
        $this->addPermission('home');
        $this->addPermission('pizza-pinboard');
        $this->addPermission('pizza-show');
        $this->addPermission('user-intro');
        $this->addPermission('user-handle-login');
        $this->addPermission('user-handle-register');
        $this->addPermission('user-registered');
    }
}
