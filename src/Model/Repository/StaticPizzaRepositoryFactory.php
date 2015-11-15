<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Repository;

use Interop\Container\ContainerInterface;

/**
 * Class StaticPizzaRepositoryFactory
 *
 * @package Application\Model\Repository
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
        $pizzaList = include APPLICATION_ROOT . '/data/pizza-list.php';

        return new StaticPizzaRepository($pizzaList);
    }
}