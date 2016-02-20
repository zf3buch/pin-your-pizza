<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Table;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Class PizzaTable
 *
 * @package Pizza\Model\Table
 */
class PizzaTable implements PizzaTableInterface
{
    /**
     * @var TableGatewayInterface|AbstractTableGateway
     */
    private $tableGateway;

    /**
     * CommentTable constructor.
     *
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Fetch all pizzas
     *
     * @param integer|null $count
     *
     * @return array
     */
    public function fetchAllPizzas($count = null)
    {
        // select pizzas
        $select = $this->tableGateway->getSql()->select();

        if ($count) {
            $select->limit($count);
        }

        // initialize data
        $data = array();

        // loop through rows
        foreach ($this->tableGateway->selectWith($select) as $row) {
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
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('id', $id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

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
        $starAddColumn = 'stars' . $star;
        $totalColumn   = 'total';

        $platform     = $this->tableGateway->getAdapter()->getPlatform();
        $stars1Column = $platform->quoteIdentifier('stars1');
        $stars2Column = $platform->quoteIdentifier('stars2');
        $stars3Column = $platform->quoteIdentifier('stars3');
        $stars4Column = $platform->quoteIdentifier('stars4');
        $stars5Column = $platform->quoteIdentifier('stars5');

        // increase
        $update = $this->tableGateway->getSql()->update();
        $update->set(
            [
                $starAddColumn => new Expression(
                    $platform->quoteIdentifier($starAddColumn) . ' + 1'
                ),
                $totalColumn   => new Expression(
                    $platform->quoteIdentifier($totalColumn) . ' + 1'
                ),
            ]
        );
        $update->where->equalTo('id', $id);

        $this->tableGateway->updateWith($update);

        // recalc
        $update = $this->tableGateway->getSql()->update();
        $update->set(
            [
                'rate' => new Expression(
                    '('
                    . $stars1Column . ' * 1 + '
                    . $stars2Column . ' * 2 + '
                    . $stars3Column . ' * 3 + '
                    . $stars4Column . ' * 4 + '
                    . $stars5Column . ' * 5 '
                    . ')'
                    . ' / '
                    . '(' . $totalColumn . ')'
                )
            ]
        );
        $update->where->equalTo('id', $id);

        $this->tableGateway->updateWith($update);

        return true;
    }
}
