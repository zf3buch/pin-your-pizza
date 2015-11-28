<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Table;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class PizzaTable
 *
 * @package Pizza\Model\Table
 */
class PizzaTable extends TableGateway implements PizzaTableInterface
{
    /**
     * PizzaTable constructor.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

        parent::__construct('pizza', $adapter, null, $resultSet);
    }

    /**
     * Fetch all pizzas
     *
     * @param integer $count
     *
     * @return array
     */
    public function fetchAllPizzas($count)
    {
        // select pizzas
        $select = $this->getSql()->select();
        $select->limit($count);

        // initialize data
        $data = array();

        // loop through rows
        foreach ($this->selectWith($select) as $row) {
            $data[] = $row;
        }

        // return data
        return $data;
    }

    /**
     * Fetch pizza by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetchPizzaById($id)
    {
        // select pizzas
        $select = $this->getSql()->select();
        $select->where->equalTo('id', $id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->selectWith($select);

        // return data
        return $resultSet->current();
    }

    /**
     * Increase pos column
     *
     * @param integer $id
     * @param integer $star
     *
     * @return bool
     */
    public function saveVoting($id, $star)
    {
        $platform      = $this->getAdapter()->getPlatform();
        $starAddColumn = $platform->quoteIdentifier('stars' . $star);
        $stars1Column  = $platform->quoteIdentifier('stars1');
        $stars2Column  = $platform->quoteIdentifier('stars2');
        $stars3Column  = $platform->quoteIdentifier('stars3');
        $stars4Column  = $platform->quoteIdentifier('stars4');
        $stars5Column  = $platform->quoteIdentifier('stars5');
        $totalColumn   = $platform->quoteIdentifier('total');

        // increase
        $update = $this->getSql()->update();
        $update->set(
            [
                $starAddColumn => new Expression($starAddColumn . ' + 1'),
                $totalColumn   => new Expression($totalColumn . ' + 1'),
            ]
        );
        $update->where->equalTo('id', $id);

        var_dump($this->getSql()->buildSqlString($update));

//        $this->updateWith($update);

        // recalc
        $update = $this->getSql()->update();
        $update->set(
            [
                'rate' => new Expression(
                    '(' . $stars1Column . ' + ' . $stars2Column . ' + '
                    . $stars3Column . ' + ' . $stars4Column . ' + '
                    . $stars5Column . ')' . '/(' . $totalColumn . ')'
                )
            ]
        );
        $update->where->equalTo('id', $id);

        var_dump($this->getSql()->buildSqlString($update));
        exit;
        
//        $this->updateWith($update);

        return true;
    }
}
