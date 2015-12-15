<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Form;

use Interop\Container\ContainerInterface;
use Pizza\Model\InputFilter\CommentInputFilter;
use Zend\Form\Form;

/**
 * Class CommentFormFactory
 *
 * @package Pizza\Form
 */
class CommentFormFactory extends Form
{
    /**
     * @param ContainerInterface $container
     *
     * @return CommentForm
     */
    public function __invoke(ContainerInterface $container)
    {
        $inputFilter = $container->get(CommentInputFilter::class);

        $form = new CommentForm();
        $form->setInputFilter($inputFilter);
        $form->init();

        return $form;
    }
}