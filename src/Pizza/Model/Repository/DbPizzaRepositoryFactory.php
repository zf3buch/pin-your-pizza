<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

use Interop\Container\ContainerInterface;
use Pizza\Model\Table\CommentTableInterface;
use Pizza\Model\Table\PizzaTableInterface;

/**
 * Class DbPizzaRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class DbPizzaRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return DbPizzaRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $pizzaTable   = $container->get(PizzaTableInterface::class);
        $commentTable = $container->get(CommentTableInterface::class);

        return new DbPizzaRepository($pizzaTable, $commentTable);
    }
}