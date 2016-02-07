<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Repository;

/**
 * Trait UserRepositoryAwareTrait
 *
 * @package User\Model\Repository
 */
trait UserRepositoryAwareTrait
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function setUserRepository(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }
}
