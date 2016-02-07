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
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class RedirectIntroAction
 *
 * @package Pizza\Action
 */
class RedirectIntroAction
{
    /**
     * use traits
     */
    use RouterAwareTrait;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return RedirectResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $routeParams = [
            'lang' => $request->getAttribute('lang'),
        ];

        return new RedirectResponse(
            $this->router->generateUri('home', $routeParams)
        );
    }
}
