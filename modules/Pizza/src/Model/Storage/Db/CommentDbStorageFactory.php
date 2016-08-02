<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Storage\Db;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class CommentDbStorageFactory
 *
 * @package Pizza\Model\Storage\Db
 */
class CommentDbStorageFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CommentDbStorage
     */
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get(AdapterInterface::class);

        $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

        $storageGateway = new TableGateway(
            'comment', $adapter, null, $resultSet
        );

        return new CommentDbStorage($storageGateway);
    }
}