<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

use Pizza\Model\Storage\CommentStorageInterface;
use Pizza\Model\Storage\PizzaStorageInterface;

/**
 * Class PizzaRepository
 *
 * @package Pizza\Model\Repository
 */
class PizzaRepository implements PizzaRepositoryInterface
{
    /**
     * @var PizzaStorageInterface
     */
    private $pizzaStorage;

    /**
     * @var CommentStorageInterface
     */
    private $commentStorage;

    /**
     * PizzaRepository constructor.
     *
     * @param PizzaStorageInterface   $pizzaStorage
     * @param CommentStorageInterface $commentStorage
     */
    public function __construct(
        PizzaStorageInterface $pizzaStorage, CommentStorageInterface $commentStorage
    ) {
        $this->pizzaStorage   = $pizzaStorage;
        $this->commentStorage = $commentStorage;
    }

    /**
     * Get pizza pinboard
     *
     * @return array
     */
    public function getPizzaPinboard()
    {
        $pizzas = $this->pizzaStorage->fetchAllPizzas();

        foreach ($pizzas as $key => $pizza) {
            $comments = $this->commentStorage->fetchCommentsByPizza(
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
        $pizza = $this->pizzaStorage->fetchPizzaById($id);

        if (!$pizza) {
            return false;
        }

        $pizza['comments'] = $this->commentStorage->fetchCommentsByPizza($id);

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
        return $this->pizzaStorage->saveVoting($id, $star);
    }
}
