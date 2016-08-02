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
use Pizza\Model\Storage\CommentStorageInterface;
use Pizza\Model\Storage\PizzaStorageInterface;

/**
 * Class PizzaRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class PizzaRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PizzaRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $pizzaStorage   = $container->get(PizzaStorageInterface::class);
        $commentStorage = $container->get(CommentStorageInterface::class);

        return new PizzaRepository($pizzaStorage, $commentStorage);
    }
}