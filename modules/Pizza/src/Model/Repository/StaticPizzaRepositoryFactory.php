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

/**
 * Class StaticPizzaRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class StaticPizzaRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return StaticPizzaRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $pizzaList = include PROJECT_ROOT . '/data/pizza-list.php';

        return new StaticPizzaRepository($pizzaList);
    }
}