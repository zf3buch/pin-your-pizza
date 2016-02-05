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
use Zend\Db\TableGateway\TableGateway;

/**
 * Class CommentTable
 *
 * @package Pizza\Model\Table
 */
class CommentTable extends TableGateway implements CommentTableInterface
{
    /**
     * CommentTable constructor.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

        parent::__construct('comment', $adapter, null, $resultSet);
    }

    /**
     * Fetch comments by pizza id
     *
     * @param integer $pizzaId
     *
     * @return array
     */
    public function fetchCommentsByPizza($pizzaId)
    {
        // select comments
        $select = $this->getSql()->select();
        $select->where->equalTo('pizza', $pizzaId);
        $select->order(['date' => 'ASC']);

        // initialize data
        $data = array();

        // loop through rows
        foreach ($this->selectWith($select) as $row) {
            $data[] = $row;
        }

        // return data
        return $data;
    }
}
