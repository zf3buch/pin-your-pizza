<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Table;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class UserTable
 *
 * @package User\Model\Table
 */
class UserTable extends TableGateway implements UserTableInterface
{
    /**
     * UserTable constructor.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

        parent::__construct('user', $adapter, null, $resultSet);
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
        $select = $this->getSql()->select();
        $select->where->equalTo('id', $id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->selectWith($select);

        // return data
        return $resultSet->current();
    }
}
