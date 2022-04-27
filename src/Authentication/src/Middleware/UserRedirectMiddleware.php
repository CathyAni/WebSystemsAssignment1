<?php

declare(strict_types=1);

namespace Authentication\Middleware;

use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Authentication\UserInterface;
use Mezzio\Session\SessionMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * This class redirects to the appropriate page based on availaible data
 * It is assumed that the user 
 */
class UserRedirectMiddleware implements MiddlewareInterface
{
    /** @var callable */
    private $user;
    /** @var string */
    private $redirect;
    public function __construct(callable $user, string $redirect)
    {
        
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $response = $handler->handle($request);
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if($session->has(UserInterface::class)){
            $sessionData = $session->get(UserInterface::class);
            $request  = $request->withAttribute(
                UserInterface::class,
                $user = ($this->user)($sessionData['username'] ?? '', $sessionData['roles'] ?? ['guest'])
            );

            $isGuest       = current($user->getRoles()) === 'guest';
            $isAtLoginPage = $request->getUri()->getPath() === $this->redirect;
    
            // if url contains referel redirect to refered page
            if (! $isGuest && $isAtLoginPage) {
                return new RedirectResponse('/');
            }
        }

        return $response;
        
    }
}