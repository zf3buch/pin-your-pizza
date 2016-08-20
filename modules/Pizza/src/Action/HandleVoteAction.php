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
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * HandleVoteAction constructor.
     *
     * @param RouterInterface          $router
     * @param PizzaRepositoryInterface $pizzaRepository
     */
    public function __construct(
        RouterInterface $router,
        PizzaRepositoryInterface $pizzaRepository
    ) {
        $this->router          = $router;
        $this->pizzaRepository = $pizzaRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return RedirectResponse
     */
    public function __invoke(
        ServerRequestInterface $request, ResponseInterface $response,
        callable $next = null
    ) {
        // get query params
        $queryParams = $request->getQueryParams();

        // get params
        $id   = $request->getAttribute('id');
        $star = (int)$queryParams['star'];

        if ($star) {
            $this->pizzaRepository->saveVoting($id, $star);
        }

        return new RedirectResponse(
            $this->router->generateUri('pizza-show', ['id' => $id])
        );
    }
}
