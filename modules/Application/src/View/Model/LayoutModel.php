<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\View\Model;

use Zend\View\Model\ViewModel;

/**
 * Class LayoutModel
 *
 * @package Application\View\Model
 */
class LayoutModel extends ViewModel
{
    /**
     * Add layout segments as child view models
     *
     * @param array $segments
     */
    public function addLayoutSegments(array $segments = [])
    {
        foreach ($segments as $segmentTemplate) {
            $segmentName = str_replace('layout/', '', $segmentTemplate);

            $viewModel = new ViewModel();
            $viewModel->setTemplate($segmentTemplate);

            $this->addChild($viewModel, $segmentName);
        }
    }
}
