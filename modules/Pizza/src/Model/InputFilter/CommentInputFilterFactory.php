<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\InputFilter;

use Interop\Container\ContainerInterface;

/**
 * Class CommentInputFilterFactory
 *
 * @package Pizza\Model\InputFilter
 */
class CommentInputFilterFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CommentInputFilter
     */
    public function __invoke(ContainerInterface $container)
    {
        $inputFilter = new CommentInputFilter();
        $inputFilter->init();

        return $inputFilter;
    }
}
