<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Authentication;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;

/**
 * Trait AuthenticationServiceAwareTrait
 *
 * @package User\Authentication
 */
trait AuthenticationServiceAwareTrait
{
    /**
     * @var AuthenticationService|AuthenticationServiceInterface
     */
    private $authenticationService;

    /**
     * @param AuthenticationService|AuthenticationServiceInterface $authenticationService
     */
    public function setAuthenticationService(
        AuthenticationServiceInterface $authenticationService
    ) {
        $this->authenticationService = $authenticationService;
    }
}
