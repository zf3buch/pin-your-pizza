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
 * Class AdminRole
 *
 * @package User\Permissions
 */
class AdminRole extends AbstractRole
{
    /**
     * AdminRole constructor.
     */
    public function __construct()
    {
        $this->addChild(new MemberRole());

        $this->addPermission('pizza-delete-comment');
    }
    /**
     * @var string
     */
    protected $name = 'admin';
}
