<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\View\Helper;

use User\Permissions\Rbac;
use Zend\View\Helper\AbstractHelper;

/**
 * Class Allowed
 *
 * @package User\View\Helper
 */
class Allowed extends AbstractHelper
{
    /**
     * @var string
     */
    private $role;

    /**
     * @var Rbac
     */
    private $rbac;

    /**
     * Allowed constructor.
     *
     * @param string $role
     * @param Rbac   $rbac
     */
    public function __construct($role, Rbac $rbac)
    {
        $this->role = $role;
        $this->rbac = $rbac;
    }

    /**
     * Return current role
     *
     * @param string $permission
     *
     * @return bool
     */
    function __invoke($permission)
    {
        return $this->rbac->isGranted($this->role, $permission);
    }
}
