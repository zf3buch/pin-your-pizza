<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Repository;

use User\Model\Table\UserTableInterface;

/**
 * Class UserRepository
 *
 * @package User\Model\Repository
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var UserTableInterface
     */
    private $userTable;

    /**
     * UserRepository constructor.
     *
     * @param UserTableInterface $userTable
     */
    public function __construct(UserTableInterface $userTable)
    {
        $this->userTable = $userTable;
    }

    /**
     * Get single user
     *
     * @param integer $id
     *
     * @return array
     */
    public function getSingleUser($id)
    {
        $user = $this->userTable->fetchUserById($id);

        if (!$user) {
            return false;
        }

        return $user;
    }

    /**
     * Save user
     *
     * @param array $data
     *
     * @return boolean
     */
    public function registerUser($data)
    {
        if (isset($data['register_user'])) {
            unset($data['register_user']);
        }

        $data['date']     = date('Y-m-d H:i:s');
        $data['password'] = password_hash(
            $data['password'], PASSWORD_BCRYPT
        );

        return $this->userTable->insert($data);
    }
}
