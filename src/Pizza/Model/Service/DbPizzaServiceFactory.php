<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Service;

use Interop\Container\ContainerInterface;
use Pizza\Model\Table\CommentTableInterface;
use Pizza\Model\Table\PizzaTableInterface;

/**
 * Class DbPizzaServiceFactory
 *
 * @package Pizza\Model\Service
 */
class DbPizzaServiceFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return DbPizzaService
     */
    public function __invoke(ContainerInterface $container)
    {
        $pizzaTable   = $container->get(PizzaTableInterface::class);
        $commentTable = $container->get(CommentTableInterface::class);

        return new DbPizzaService($pizzaTable, $commentTable);
    }
}