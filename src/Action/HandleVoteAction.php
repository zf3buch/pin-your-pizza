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
     * @return HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request, ResponseInterface $response,
        callable $next = null
    ) {
        // get params
        $id   = $request->getAttribute('id');
        $vote = 5;

        $this->pizzaRepository->saveVoting($id, $vote);

        return new RedirectResponse(
            $this->router->generateUri('show-pizza', ['id' => $id])
        );
    }
}