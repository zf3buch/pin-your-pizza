<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Bootstrap\View\Helper;

use Zend\Form\FormInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

/**
 * Class Form
 *
 * @package Bootstrap\View\Helper
 */
class Form extends AbstractHelper
{
    /**
     * Render form with template
     *
     * @param FormInterface $form
     *
     * @return string
     */
    function __invoke(FormInterface $form)
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('bootstrap::form');
        $viewModel->setVariable('form', $form);

        return $this->getView()->render($viewModel);
    }
}
