<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\View\Helper;

use Interop\Container\ContainerInterface;
use User\Permissions\Rbac;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\View\HelperPluginManager;

/**
 * Class AllowedFactory
 *
 * @package User\View\Helper
 */
class AllowedFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Allowed
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

        $viewHelper = new Allowed($role, $rbac);

        return $viewHelper;
    }
}