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
     * @var PizzaServiceInterface
     */
    private $pizzaService;

    /**
     * @var CommentForm
     */
    private $commentForm;

    /**
     * HandleCommentAction constructor.
     *
     * @param RouterInterface       $router
     * @param PizzaServiceInterface $pizzaService
     * @param CommentForm           $commentForm
     */
    public function __construct(
        RouterInterface $router,
        PizzaServiceInterface $pizzaService,
        CommentForm $commentForm
    ) {
        $this->router       = $router;
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
        $id = $request->getAttribute('id');

        $postData = $request->getParsedBody();

        $this->commentForm->setData($postData);

        if ($this->commentForm->isValid()) {
            $this->pizzaService->saveComment(
                $id, $this->commentForm->getData()
            );

            return new RedirectResponse(
                $this->router->generateUri('pizza-show', ['id' => $id])
            );
        }

        return $next($request, $response);
    }
}
