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
 * Trait CommentRepositoryAwareTrait
 *
 * @package Pizza\Model\Repository
 */
trait CommentRepositoryAwareTrait
{
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * @param CommentRepositoryInterface $commentRepository
     */
    public function setCommentRepository(
        CommentRepositoryInterface $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
    }
}
