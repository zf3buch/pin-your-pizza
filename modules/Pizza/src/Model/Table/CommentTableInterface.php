<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Table;

use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Interface CommentTableInterface
 *
 * @package Pizza\Model\Table
 */
interface CommentTableInterface extends TableGatewayInterface
{
    /**
     * Fetch comments by pizza id
     *
     * @param integer $pizzaId
     *
     * @return array
     */
    public function fetchCommentsByPizza($pizzaId);
}