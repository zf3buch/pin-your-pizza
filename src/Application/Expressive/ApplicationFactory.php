<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Expressive;

use Application\I18n\Observer\SetLanguageObserver;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory as ExpressiveApplicationFactory;

/**
 * Class ApplicationFactory
 *
 * @package Application\Expressive
 */
class ApplicationFactory extends ExpressiveApplicationFactory
{
    /**
     * Create and return an Application instance.
     *
     * @param ContainerInterface $container
     *
     * @return Application
     */
    public function __invoke(ContainerInterface $container)
    {
        $application = parent::__invoke($container);
        $application->attachRouteResultObserver(
            $container->get(SetLanguageObserver::class)
        );

        return $application;
    }

}