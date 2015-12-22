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
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleCommentAction
 *
 * @package Application\Action
 */
class HandleCommentAction
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
     * @var CommentForm
     */
    private $commentForm;

    /**
     * HandleCommentAction constructor.
     *
     * @param RouterInterface          $router
     * @param PizzaRepositoryInterface $pizzaRepository
     * @param CommentForm              $commentForm
     */
    public function __construct(
        RouterInterface $router,
        PizzaRepositoryInterface $pizzaRepository,
        CommentForm $commentForm
    ) {
        $this->router          = $router;
        $this->pizzaRepository = $pizzaRepository;
        $this->commentForm     = $commentForm;
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
        $id = $request->getAttribute('id');

        $postData = $request->getParsedBody();

        $this->commentForm->setData($postData);

        if ($this->commentForm->isValid()) {
            $this->pizzaRepository->saveComment(
                $id, $this->commentForm->getData()
            );

            $routeParams = [
                'id'   => $id,
                'lang' => $request->getAttribute('lang'),
            ];

            return new RedirectResponse(
                $this->router->generateUri('pizza-show', $routeParams)
            );
        }

        return $next($request, $response);
    }
}
