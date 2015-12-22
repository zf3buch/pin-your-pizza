<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n\Observer;

use Interop\Container\ContainerInterface;

/**
 * Class SetLanguageObserverFactory
 *
 * @package Application\I18n\Observer
 */
class SetLanguageObserverFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return SetLanguageObserver
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['i18n'];

        return new SetLanguageObserver(
            $config['defaultLang'], $config['allowedLocales']
        );
    }
}
