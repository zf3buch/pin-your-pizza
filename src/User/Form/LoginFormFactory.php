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
use User\Model\InputFilter\LoginInputFilter;
use Zend\Form\Form;

/**
 * Class LoginFormFactory
 *
 * @package User\Form
 */
class LoginFormFactory extends Form
{
    /**
     * @param ContainerInterface $container
     *
     * @return LoginForm
     */
    public function __invoke(ContainerInterface $container)
    {
        $inputFilter = $container->get(LoginInputFilter::class);

        $form = new LoginForm();
        $form->setInputFilter($inputFilter);
        $form->init();

        return $form;
    }
}