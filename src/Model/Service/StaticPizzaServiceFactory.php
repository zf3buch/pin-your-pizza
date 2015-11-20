<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Model\Service;

use Interop\Container\ContainerInterface;

/**
 * Class StaticPizzaServiceFactory
 *
 * @package Application\Model\Service
 */
class StaticPizzaServiceFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return StaticPizzaService
     */
    public function __invoke(ContainerInterface $container)
    {
        $pizzaList = include APPLICATION_ROOT . '/data/pizza-list.php';

        return new StaticPizzaService($pizzaList);
    }
}