<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class HomePageAction
 *
 * @package Application\Action
 */
class HomePageAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;

    /**
     * HomePageAction constructor.
     *
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(
        TemplateRendererInterface $template = null
    ) {
        $this->template = $template;
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
        $data = [
            'welcome' => 'Willkommen zu Pin Your Pizza!'
        ];

        if (!$this->template) {
            return new JsonResponse($data);
        }

        return new HtmlResponse(
            $this->template->render('application::home-page', $data)
        );
    }
}
