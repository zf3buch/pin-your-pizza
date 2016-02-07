<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Application\Router\RouterAwareTrait;
use Pizza\Model\Repository\PizzaRepositoryAwareTrait;
use Pizza\Model\Repository\PizzaRepositoryInterface;
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
     * use traits
     */
    use RouterAwareTrait;
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
        // get query params
        $queryParams = $request->getQueryParams();

        // get params
        $id   = $request->getAttribute('id');
        $star = (int) $queryParams['star'];

        if ($star) {
            $this->pizzaRepository->saveVoting($id, $star);
        }

        $routeParams = [
            'id'   => $id,
            'lang' => $request->getAttribute('lang'),
        ];

        return new RedirectResponse(
            $this->router->generateUri('pizza-show', $routeParams)
        );
    }
}
