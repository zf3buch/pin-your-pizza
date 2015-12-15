<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Form\CommentForm;
use Pizza\Model\Service\PizzaServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowPizzaAction
 *
 * @package Application\Action
 */
class ShowPizzaAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * @var PizzaServiceInterface
     */
    private $pizzaService;

    /**
     * @var CommentForm
     */
    private $commentForm;

    /**
     * ShowPizzaAction constructor.
     *
     * @param TemplateRendererInterface $template
     * @param PizzaServiceInterface     $pizzaService
     * @param CommentForm               $commentForm
     */
    public function __construct(
        TemplateRendererInterface $template,
        PizzaServiceInterface $pizzaService,
        CommentForm $commentForm
    ) {
        $this->template     = $template;
        $this->pizzaService = $pizzaService;
        $this->commentForm  = $commentForm;
    }

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

        $pizza = $this->pizzaService->getSinglePizza($id);

        $data = [
            'pizza'       => $pizza,
            'commentForm' => $this->commentForm,
        ];

        return new HtmlResponse(
            $this->template->render('pizza::show', $data)
        );
    }
}
