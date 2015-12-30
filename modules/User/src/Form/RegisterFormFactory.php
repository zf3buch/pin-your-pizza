<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Form;

use Interop\Container\ContainerInterface;
use User\Model\InputFilter\RegisterInputFilter;
use Zend\Form\Form;

/**
 * Class RegisterFormFactory
 *
 * @package User\Form
 */
class RegisterFormFactory extends Form
{
    /**
     * @param ContainerInterface $container
     *
     * @return RegisterForm
     */
    public function __invoke(ContainerInterface $container)
    {
        $inputFilter = $container->get(RegisterInputFilter::class);

        $form = new RegisterForm();
        $form->setInputFilter($inputFilter);
        $form->init();

        return $form;
    }
}