<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Authorization;

use User\Permissions\Rbac;
use Zend\Authentication\Exception\RuntimeException;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Router\RouteResultObserverInterface;

/**
 * Class Authorization
 *
 * @package User\Authorization
 */
class AuthorizationObserver implements RouteResultObserverInterface
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
     * Authorization constructor.
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
     * Observe a route result.
     *
     * @param RouteResult $result
     */
    public function update(RouteResult $result)
    {
        $permission = $result->getMatchedRouteName();

        if (!$this->rbac->isGranted($this->role, $permission)) {
            throw new RuntimeException(
                'user_heading_not_allowed',
                403
            );
        }
    }
}
