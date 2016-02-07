<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Form;

/**
 * Trait CommentFormAwareTrait
 *
 * @package Pizza\Form
 */
class CommentFormAwareTrait
{
    /**
     * @var CommentForm
     */
    private $commentForm;

    /**
     * @param CommentForm $commentForm
     */
    public function setCommentForm(CommentForm $commentForm)
    {
        $this->commentForm = $commentForm;
    }
}
