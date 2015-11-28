<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Model\Service\PizzaServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleVoteAction
 *
 * @package Application\Action
 */
class HandleVoteAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var PizzaServiceInterface
     */
    private $pizzaService;

    /**
     * HandleVoteAction constructor.
     *
     * @param RouterInterface       $router
     * @param PizzaServiceInterface $pizzaService
     */
    public function __construct(
        RouterInterface $router,
        PizzaServiceInterface $pizzaService
    ) {
        $this->router       = $router;
        $this->pizzaService = $pizzaService;
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
        // get query params
        $queryParams = $request->getQueryParams();

        // get params
        $id   = $request->getAttribute('id');
        $star = (int) $queryParams['star'];

        if ($star) {
            $this->pizzaService->saveVoting($id, $star);
        }

        return new RedirectResponse(
            $this->router->generateUri('show-pizza', ['id' => $id])
        );
    }
}
