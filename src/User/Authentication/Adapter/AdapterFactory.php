<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Authentication\Adapter;

use Interop\Container\ContainerInterface;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class AdapterFactory
 *
 * @package User\Authentication\Adapter
 */
class AdapterFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CallbackCheckAdapter
     */
    public function __invoke(ContainerInterface $container)
    {
        $dbAdapter = $container->get(AdapterInterface::class);

        $authAdapter = new CallbackCheckAdapter(
            $dbAdapter,
            'user',
            'email',
            'password',
            function ($hash, $password) {
                return password_verify($password, $hash);
            }
        );

        return $authAdapter;
    }
}
