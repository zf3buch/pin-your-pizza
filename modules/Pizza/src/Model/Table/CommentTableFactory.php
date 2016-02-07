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

/**
 * Class CommentTableFactory
 *
 * @package Pizza\Model\Table
 */
class CommentTableFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CommentTable
     */
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get(AdapterInterface::class);

        return new CommentTable($adapter);
    }
}