<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Authentication;

use Interop\Container\ContainerInterface;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;

/**
 * Class AuthenticationServiceFactory
 *
 * @package User\Authentication
 */
class AuthenticationServiceFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return AuthenticationService
     */
    public function __invoke(ContainerInterface $container)
    {
        $authAdapter = $container->get(AdapterInterface::class);

        $authService = new AuthenticationService();
        $authService->setAdapter($authAdapter);

        return $authService;
    }
}