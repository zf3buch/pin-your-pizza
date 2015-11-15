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
 * Interface PizzaRepositoryInterface
 *
 * @package Model\Repository
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
     * @param boolean $vote
     *
     * @return boolean
     */
    public function saveVoting($id, $vote);

    /**
     * Save comment for a single pizza
     *
     * @param integer $id
     * @param string  $comment
     *
     * @return boolean
     */
    public function saveComment($id, $comment);
}