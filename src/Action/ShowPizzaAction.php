<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Application\Model\Repository\PizzaRepositoryInterface;
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
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * ShowPizzaAction constructor.
     *
     * @param TemplateRendererInterface $template
     * @param PizzaRepositoryInterface  $pizzaRepository
     */
    public function __construct(
        TemplateRendererInterface $template,
        PizzaRepositoryInterface $pizzaRepository
    ) {
        $this->template   = $template;
        $this->pizzaRepository = $pizzaRepository;
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

        $pizza = $this->pizzaRepository->getSinglePizza($id);

        $data = [
            'pizza' => $pizza,
        ];

        return new HtmlResponse(
            $this->template->render('application::show-pizza', $data)
        );
    }
}
