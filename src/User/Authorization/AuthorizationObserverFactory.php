<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Authorization;

use Interop\Container\ContainerInterface;
use User\Permissions\Rbac;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Expressive\Application;

/**
 * Class AuthorizationObserverFactory
 *
 * @package User\Authorization
 */
class AuthorizationObserverFactory
{
    /**
     * Create and return a AuthorizationObserver instance.
     *
     * @param ContainerInterface $container
     *
     * @return AuthorizationObserver
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var AuthenticationServiceInterface $authenticationService */
        $authenticationService = $container->get(
            AuthenticationServiceInterface::class
        );

        if ($authenticationService->hasIdentity()) {
            $role = $authenticationService->getIdentity()->role;
        } else {
            $role = 'guest';
        }

        $rbac = $container->get(Rbac::class);

        return new AuthorizationObserver($role, $rbac);
    }
}
