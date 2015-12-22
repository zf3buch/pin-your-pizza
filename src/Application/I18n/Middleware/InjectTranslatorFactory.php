<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\I18n\Middleware;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;
use Zend\View\HelperPluginManager;

/**
 * Class InjectTranslatorFactory
 *
 * @package Application\I18n\Middleware
 */
class InjectTranslatorFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InjectTranslator
     */
    public function __invoke(ContainerInterface $container)
    {
        $translator          = $container->get(Translator::class);
        $helperPluginManager = $container->get(HelperPluginManager::class);

        return new InjectTranslator(
            $translator, $helperPluginManager
        );
    }
}
