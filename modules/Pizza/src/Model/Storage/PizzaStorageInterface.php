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
 * Interface PizzaStorageInterface
 *
 * @package Pizza\Model\Storage
 */
interface PizzaStorageInterface
{
    /**
     * Fetch all pizzas
     *
     * @param integer|null $count
     *
     * @return array
     */
    public function fetchAllPizzas($count = null);

    /**
     * Fetch pizza by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetchPizzaById($id);

    /**
     * Increase pos column
     *
     * @param integer $id
     * @param integer $star
     *
     * @return bool
     */
    public function saveVoting($id, $star);
}
