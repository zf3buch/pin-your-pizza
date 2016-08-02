<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Storage;

/**
 * Interface UserStorageInterface
 *
 * @package User\Model\Storage
 */
interface UserStorageInterface
{
    /**
     * Fetch user by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetchUserById($id);

    /**
     * Insert a user
     *
     * @param array $data
     *
     * @return mixed
     */
    public function insertUser(array $data = array());
}
