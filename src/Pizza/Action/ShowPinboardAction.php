<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Model\Repository\PizzaRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class ShowPinboardAction
 *
 * @package Application\Action
 */
class ShowPinboardAction
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
     * ShowPinboardAction constructor.
     *
     * @param TemplateRendererInterface $template
     * @param PizzaRepositoryInterface     $pizzaRepository
     */
    public function __construct(
        TemplateRendererInterface $template,
        PizzaRepositoryInterface $pizzaRepository
    ) {
        $this->template     = $template;
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
        $pizzaList = $this->pizzaRepository->getPizzaPinboard();

        $data = [
            'welcome'   => 'Willkommen zu Pin Your Pizza!',
            'pizzaList' => $pizzaList,
        ];

        return new HtmlResponse(
            $this->template->render('pizza::pinboard', $data)
        );
    }
}
