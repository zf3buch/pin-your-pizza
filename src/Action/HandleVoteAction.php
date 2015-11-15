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
    private $repository;

    /**
     * HandleVoteAction constructor.
     *
     * @param RouterInterface          $router
     * @param PizzaRepositoryInterface $repository
     */
    public function __construct(
        RouterInterface $router,
        PizzaRepositoryInterface $repository
    ) {
        $this->router     = $router;
        $this->repository = $repository;
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

        $pizza = $this->repository->getSinglePizza($id);

        $data = [
            'pizza' => $pizza,
        ];

        return new HtmlResponse(
            $this->template->render('application::show-pizza', $data)
        );
    }
}
