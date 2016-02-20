<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Table;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Class UserTable
 *
 * @package User\Model\Table
 */
class UserTable implements UserTableInterface
{
    /**
     * @var TableGatewayInterface|AbstractTableGateway
     */
    private $tableGateway;

    /**
     * UserTable constructor.
     *
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct($tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Fetch user by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetchUserById($id)
    {
        // select users
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('id', $id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

        // return data
        return $resultSet->current();
    }

    /**
     * Insert a user
     *
     * @param array $data
     *
     * @return mixed
     */
    public function insertUser(array $data = [])
    {
        return $this->tableGateway->insert($data);
    }
}
