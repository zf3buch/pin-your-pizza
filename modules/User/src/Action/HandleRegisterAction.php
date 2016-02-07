<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use User\Form\RegisterForm;
use User\Model\Repository\UserRepositoryInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleRegisterAction
 *
 * @package User\Action
 */
class HandleRegisterAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var RegisterForm
     */
    private $registerForm;

    /**
     * HandleRegisterAction constructor.
     *
     * @param RouterInterface         $router
     * @param UserRepositoryInterface $userRepository
     * @param RegisterForm            $registerForm
     */
    public function __construct(
        RouterInterface $router,
        UserRepositoryInterface $userRepository,
        RegisterForm $registerForm
    ) {
        $this->router         = $router;
        $this->userRepository = $userRepository;
        $this->registerForm   = $registerForm;
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
        $postData = $request->getParsedBody();

        $this->registerForm->setData($postData);

        if ($this->registerForm->isValid()) {
            $this->userRepository->registerUser(
                $this->registerForm->getData()
            );

            $routeParams = [
                'lang' => $request->getAttribute('lang'),
            ];

            return new RedirectResponse(
                $this->router->generateUri('user-registered', $routeParams)
            );
        }

        return $next($request, $response);
    }
}
