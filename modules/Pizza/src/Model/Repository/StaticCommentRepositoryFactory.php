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
 * Class StaticCommentRepositoryFactory
 *
 * @package Pizza\Model\Repository
 */
class StaticCommentRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return StaticCommentRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        return new StaticCommentRepository();
    }
}