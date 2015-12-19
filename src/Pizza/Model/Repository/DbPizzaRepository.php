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
 * Class DbPizzaRepository
 *
 * @package Pizza\Model\Repository
 */
class DbPizzaRepository implements PizzaRepositoryInterface
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
     * DbPizzaRepository constructor.
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

        return $this->commentTable->insert($insertData);
    }

}