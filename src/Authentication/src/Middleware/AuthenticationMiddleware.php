<?php

declare(strict_types=1);

namespace Authentication\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Authentication\Service\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{
    /**
     * @var AuthenticationInterface
     */
    private $auth;

 public function __construct(AuthenticationInterface $auth)
 {
     $this->auth = $auth;
 }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // $response = $handler->handle($request);
        $user = $this->auth->authenticate($request);
       
        if(null !== $user){
            return $handler->handle($request->withAttribute(UserInterface::class, $user));
        }
        return $this->auth->unauthorizedResponse($request);
    }
}
