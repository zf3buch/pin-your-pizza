<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Template;

use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Trait TemplateRendererAwareTrait
 *
 * @package Application\Template
 */
trait TemplateRendererAwareTrait
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @param TemplateRendererInterface $renderer
     */
    public function setTemplateRenderer(
        TemplateRendererInterface $renderer
    ) {
        $this->renderer = $renderer;
    }
}
