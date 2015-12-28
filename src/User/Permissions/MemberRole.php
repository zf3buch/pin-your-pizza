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
 * Class MemberRole
 *
 * @package User\Permissions
 */
class MemberRole extends AbstractRole
{
    /**
     * @var string
     */
    protected $name = 'member';

    /**
     * MemberRole constructor.
     */
    public function __construct()
    {
        $this->addPermission('home');
        $this->addPermission('pizza-pinboard');
        $this->addPermission('pizza-show');
        $this->addPermission('pizza-vote');
        $this->addPermission('pizza-comment');
        $this->addPermission('user-handle-logout');
    }
}
