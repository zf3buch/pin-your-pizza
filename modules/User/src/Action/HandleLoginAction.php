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
use User\Form\LoginForm;
use Zend\Authentication\Adapter\DbTable\AbstractAdapter;
use Zend\Authentication\Adapter\DbTable\Exception\RuntimeException;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Result;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class HandleLoginAction
 *
 * @package User\Action
 */
class HandleLoginAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * @var AuthenticationServiceInterface|AuthenticationService
     */
    private $authService;

    /**
     * HandleLoginAction constructor.
     * @param RouterInterface                $router
     * @param LoginForm                      $loginForm
     * @param AuthenticationServiceInterface $authService
     */
    public function __construct(
        RouterInterface $router,
        LoginForm $loginForm,
        AuthenticationServiceInterface $authService
    ) {
        $this->router      = $router;
        $this->loginForm   = $loginForm;
        $this->authService = $authService;
    }

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
        $postData = $request->getParsedBody();

        $this->loginForm->setData($postData);

        if (!$this->loginForm->isValid()) {
            return $next($request, $response);
        }

        /** @var ValidatableAdapterInterface|AbstractAdapter $authAdapter */
        $authAdapter = $this->authService->getAdapter();

        $authAdapter->setIdentity($postData['email']);
        $authAdapter->setCredential($postData['password']);

        try {
            $result = $this->authService->authenticate();
        } catch (RuntimeException $e) {
            return $next($request, $response);
        }

        if (!$result->isValid()) {
            switch ($result->getCode()) {
                case Result::FAILURE_CREDENTIAL_INVALID:
                    $request = $request->withAttribute(
                        'auth_error',
                        'user_auth_password_invalid'
                    );
                    break;

                case Result::FAILURE_IDENTITY_NOT_FOUND:
                    $request = $request->withAttribute(
                        'auth_error',
                        'user_auth_email_unknown'
                    );
                    break;
            }

            return $next($request, $response);
        }

        $this->authService->getStorage()->write(
            $authAdapter->getResultRowObject(null, ['password'])
        );

        $routeParams = ['lang' => $request->getAttribute('lang'),];

        return new RedirectResponse(
            $this->router->generateUri('home', $routeParams)
        );
    }
}
