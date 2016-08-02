<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Storage\Db;

use Pizza\Model\Storage\CommentStorageInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Class CommentDbStorage
 *
 * @package Pizza\Model\Storage\Db
 */
class CommentDbStorage implements CommentStorageInterface
{
    /**
     * @var TableGatewayInterface|AbstractTableGateway
     */
    private $tableGateway;

    /**
     * CommentDbStorage constructor.
     *
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
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
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('pizza', $pizzaId);
        $select->order(['date' => 'ASC']);

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
     * Save a comment
     *
     * @param array $data
     *
     * @return mixed
     */
    public function saveComment(array $data = array())
    {
        return $this->tableGateway->insert($data);
    }

    /**
     * Delete a comment
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function deleteComment($id)
    {
        return $this->tableGateway->delete(['id' => $id]);
    }
}
