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
 * Class CommentRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class CommentRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CommentRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $commentTable = $container->get(CommentTableInterface::class);

        return new CommentRepository($commentTable);
    }
}