<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Action;

use Pizza\Model\Repository\CommentRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class DeleteCommentAction
 *
 * @package Pizza\Action
 */
class DeleteCommentAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * DeleteCommentAction constructor.
     *
     * @param RouterInterface            $router
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(
        RouterInterface $router,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->router            = $router;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $id        = $request->getAttribute('id');
        $commentId = $request->getAttribute('commentId');

        $this->commentRepository->deleteComment($commentId);

        $routeParams = [
            'id'   => $id,
            'lang' => $request->getAttribute('lang'),
        ];

        return new RedirectResponse(
            $this->router->generateUri('pizza-show', $routeParams)
        );
    }
}
