<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Service;

/**
 * Class StaticPizzaService
 *
 * @package Pizza\Model\Service
 */
class StaticPizzaService implements PizzaServiceInterface
{
    /**
     * @var array
     */
    private $pizzaList = [];

    /**
     * StaticPizzaService constructor.
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
     * @param integer $star
     *
     * @return boolean
     */
    public function saveVoting($id, $star)
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