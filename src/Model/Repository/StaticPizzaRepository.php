<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Repository;

/**
 * Class StaticPizzaRepository
 *
 * @package Application\Model\Repository
 */
class StaticPizzaRepository implements PizzaRepositoryInterface
{
    /**
     * @var array
     */
    private $pizzaList = [];

    /**
     * StaticPizzaRepository constructor.
     *
     * @param array $pizzaList
     */
    public function __construct(array $pizzaList)
    {
        $this->pizzaList = $pizzaList;
    }

    /**
     * Get pizza pinboard
     *
     * @return array
     */
    public function getPizzaPinboard()
    {
        return $this->pizzaList;
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
        if (!isset($this->pizzaList[$id])) {
            return false;
        }

        return $this->pizzaList[$id];
    }

    /**
     * Save vote for a single pizza
     *
     * @param integer $id
     * @param boolean $vote
     *
     * @return boolean
     */
    public function saveVoting($id, $vote)
    {
        return true;
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
        return true;
    }

}