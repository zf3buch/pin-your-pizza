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
 * Class PizzaRepository
 *
 * @package Pizza\Model\Repository
 */
class PizzaRepository implements PizzaRepositoryInterface
{
    /**
     * @var PizzaTableInterface
     */
    private $pizzaTable;

    /**
     * @var CommentTableInterface
     */
    private $commentTable;

    /**
     * PizzaRepository constructor.
     *
     * @param PizzaTableInterface   $pizzaTable
     * @param CommentTableInterface $commentTable
     */
    public function __construct(
        PizzaTableInterface $pizzaTable, CommentTableInterface $commentTable
    ) {
        $this->pizzaTable   = $pizzaTable;
        $this->commentTable = $commentTable;
    }

    /**
     * Get pizza pinboard
     *
     * @return array
     */
    public function getPizzaPinboard()
    {
        $pizzas = $this->pizzaTable->fetchAllPizzas();

        foreach ($pizzas as $key => $pizza) {
            $comments = $this->commentTable->fetchCommentsByPizza(
                $pizza['id']
            );

            $pizzas[$key]['comments'] = $comments;
        }

        return $pizzas;
    }

    /**
     * Get single pizza
     *
     * @param integer $id
     *
     * @return array|bool
     */
    public function getSinglePizza($id)
    {
        $pizza = $this->pizzaTable->fetchPizzaById($id);

        if (!$pizza) {
            return false;
        }

        $pizza['comments'] = $this->commentTable->fetchCommentsByPizza($id);

        return $pizza;
    }

    /**
     * Save vote for a single pizza
     *
     * @param integer $id
     * @param integer $star
     *
     * @return boolean
     */
    public function saveVoting($id, $star)
    {
        return $this->pizzaTable->saveVoting($id, $star);
    }
}
