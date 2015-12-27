<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

/**
 * Class StaticCommentRepository
 *
 * @package Pizza\Model\Repository
 */
class StaticCommentRepository implements CommentRepositoryInterface
{
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
        return true;
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
        return true;
    }
}
