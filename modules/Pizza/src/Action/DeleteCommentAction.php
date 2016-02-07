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
use Pizza\Model\Repository\CommentRepositoryAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class DeleteCommentAction
 *
 * @package Pizza\Action
 */
class DeleteCommentAction
{
    /**
     * use traits
     */
    use RouterAwareTrait;
    use CommentRepositoryAwareTrait;

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
