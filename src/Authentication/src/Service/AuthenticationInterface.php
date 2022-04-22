<?php

declare(strict_types=1);
namespace Authentication\Service;

use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Authentication\AuthenticationInterface as Auth;
use Psr\Http\Message\ServerRequestInterface;
use Mezzio\Authentication\UserInterface;
use Mezzio\Session\SessionMiddleware;
use Psr\Http\Message\ResponseInterface;

class AuthenticationInterface implements Auth {

    public function authenticate(ServerRequestInterface $request): ?UserInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        $hasSessionData = $session->has(UserInterface::class);
        if($hasSessionData){
            return unserialize($session->get(UserInterface::class));
        }
        return null;
    }


    public function unauthorizedResponse(ServerRequestInterface $request): ResponseInterface
    {
        return new RedirectResponse("/logout");
    }

}
