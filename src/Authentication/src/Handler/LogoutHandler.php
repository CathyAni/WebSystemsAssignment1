<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Flash\FlashMessageMiddleware;
use Mezzio\Session\SessionMiddleware;
use Mezzio\Template\TemplateRendererInterface;

class LogoutHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        $session->unset(UserInterface::class);

        $flashMessages = $request->getAttribute(FlashMessageMiddleware::FLASH_ATTRIBUTE);
        $flashMessages->flash('message', 'You are succesfully logged out');

        return new RedirectResponse('/login');
    }
}
