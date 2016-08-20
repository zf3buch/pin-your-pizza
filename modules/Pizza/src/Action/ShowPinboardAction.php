<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Application\Template\TemplateRendererAwareTrait;
use Pizza\Model\Repository\PizzaRepositoryAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class ShowPinboardAction
 *
 * @package Application\Action
 */
class ShowPinboardAction
{
    /**
     * use traits
     */
    use TemplateRendererAwareTrait;
    use PizzaRepositoryAwareTrait;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request, ResponseInterface $response,
        callable $next = null
    ) {
        $pizzaList = $this->pizzaRepository->getPizzaPinboard();

        $data = [
            'welcome'   => 'pizza_heading_welcome',
            'pizzaList' => $pizzaList,
        ];

        return new HtmlResponse(
            $this->renderer->render('pizza::pinboard', $data)
        );
    }
}
