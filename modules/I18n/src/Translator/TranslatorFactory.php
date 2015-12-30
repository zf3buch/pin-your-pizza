<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace I18n\Translator;

use Interop\Container\ContainerInterface;

/**
 * Class TranslatorFactory
 *
 * @package I18n\Translator
 */
class TranslatorFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Translator
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        $translator = Translator::factory($config['translate']);

        return $translator;
    }
}
