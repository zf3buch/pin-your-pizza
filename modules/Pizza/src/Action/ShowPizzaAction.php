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
use Pizza\Form\CommentFormAwareTrait;
use Pizza\Model\Repository\PizzaRepositoryAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class ShowPizzaAction
 *
 * @package Application\Action
 */
class ShowPizzaAction
{
    /**
     * use traits
     */
    use TemplateRendererAwareTrait;
    use PizzaRepositoryAwareTrait;
    use CommentFormAwareTrait;

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
        // get id
        $id = $request->getAttribute('id');

        $pizza = $this->pizzaRepository->getSinglePizza($id);

        $data = [
            'pizza'       => $pizza,
            'commentForm' => $this->commentForm,
        ];

        return new HtmlResponse(
            $this->renderer->render('pizza::show', $data)
        );
    }
}
