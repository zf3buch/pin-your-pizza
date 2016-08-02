<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Storage;

/**
 * Interface CommentStorageInterface
 *
 * @package Pizza\Model\Storage
 */
interface CommentStorageInterface
{
    /**
     * Fetch comments by pizza id
     *
     * @param integer $pizzaId
     *
     * @return array
     */
    public function fetchCommentsByPizza($pizzaId);

    /**
     * Save a comment
     *
     * @param array $data
     *
     * @return mixed
     */
    public function saveComment(array $data = array());

    /**
     * Delete a comment
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function deleteComment($id);
}
