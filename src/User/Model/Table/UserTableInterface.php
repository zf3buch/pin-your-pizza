<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Table;

use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Interface UserTableInterface
 *
 * @package User\Model\Table
 */
interface UserTableInterface extends TableGatewayInterface
{
    /**
     * Fetch user by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetchUserById($id);
}
