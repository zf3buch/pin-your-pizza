<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\View\Helper;

use stdClass;
use Zend\View\Helper\AbstractHelper;

/**
 * Class Identity
 *
 * @package User\View\Helper
 */
class Identity extends AbstractHelper
{
    /**
     * @var stdClass
     */
    private $identity;

    /**
     * Identity constructor.
     *
     * @param stdClass $identity
     */
    public function __construct(stdClass $identity)
    {
        $this->identity = $identity;
    }

    /**
     * Return current identity
     *
     * @return stdClass
     */
    function __invoke()
    {
        return $this->identity;
    }
}
