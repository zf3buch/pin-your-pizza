<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Table;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class PizzaTableFactory
 *
 * @package Pizza\Model\Table
 */
class PizzaTableFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PizzaTable
     */
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get(AdapterInterface::class);

        $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

        $tableGateway = new TableGateway(
            'pizza', $adapter, null, $resultSet
        );

        return new PizzaTable($tableGateway);
    }
}