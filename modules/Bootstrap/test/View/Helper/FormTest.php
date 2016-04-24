<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace BootstrapTest\View\Helper;

use PHPUnit_Framework_TestCase;
use Bootstrap\View\Helper\Form;
use Prophecy\Prophecy\MethodProphecy;
use Zend\Form\FormInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface;

/**
 * Class FormTest
 *
 * @package BootstrapTest\View\Helper
 */
class FormTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test form return
     */
    public function testFormReturn()
    {
        $renderedHtml = '<form></form>';

        /** @var RendererInterface $renderer */
        $renderer = $this->prophesize(RendererInterface::class);

        $form = $this->prophesize(FormInterface::class);

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $form->reveal());
        $viewModel->setTemplate('bootstrap::form');

        /** @var MethodProphecy $method */
        $method = $renderer->render($viewModel);
        $method->willReturn($renderedHtml);
        $method->shouldBeCalled();

        $viewHelper = new Form();
        $viewHelper->setView($renderer->reveal());

        $this->assertEquals($renderedHtml, $viewHelper($form->reveal()));
    }
}
