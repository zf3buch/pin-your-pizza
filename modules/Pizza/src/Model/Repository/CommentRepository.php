<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;
use Pizza\Model\Table\CommentTableInterface;
use Pizza\Model\Table\PizzaTableInterface;

/**
 * Class CommentRepository
 *
 * @package Pizza\Model\Repository
 */
class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @var CommentTableInterface
     */
    private $commentTable;

    /**
     * CommentRepository constructor.
     *
     * @param CommentTableInterface $commentTable
     */
    public function __construct(
        CommentTableInterface $commentTable
    ) {
        $this->commentTable = $commentTable;
    }

    /**
     * Save comment for a single pizza
     *
     * @param integer $id
     * @param array   $data
     *
     * @return boolean
     */
    public function saveComment($id, $data)
    {
        $insertData = [
            'pizza' => $id,
            'date'  => date('Y-m-d H:i:s'),
            'name'  => isset($data['name']) ? $data['name'] : 'unbekannt',
            'text'  => isset($data['text']) ? $data['text'] : 'kein Kommentar',
        ];

        return $this->commentTable->saveComment($insertData);
    }

    /**
     * Delete comment
     *
     * @param integer $id
     *
     * @return boolean
     */
    public function deleteComment($id)
    {
        return $this->commentTable->deleteComment($id);
    }
}
