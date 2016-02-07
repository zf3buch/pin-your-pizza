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
 * Interface PizzaRepositoryInterface
 *
 * @package Pizza\Model\Repository
 */
interface PizzaRepositoryInterface
{
    /**
     * Get pizza pinboard
     *
     * @return array
     */
    public function getPizzaPinboard();

    /**
     * Get single pizza
     *
     * @param integer $id
     *
     * @return array
     */
    public function getSinglePizza($id);

    /**
     * Save vote for a single pizza
     *
     * @param integer $id
     * @param integer $star
     *
     * @return boolean
     */
    public function saveVoting($id, $star);
}