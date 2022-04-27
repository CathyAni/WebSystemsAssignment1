<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Authentication\Adapter\AuthenticationAdapter;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Session\SessionMiddleware;

class LoginHandler implements RequestHandlerInterface
{

    /**
     * @var AuthenticationAdapter
     */
    private $authAdapter;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer, AuthenticationAdapter $authAdapter)
    {
        $this->renderer = $renderer;
        $this->authAdapter = $authAdapter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Do some work...
        // Render and return a response:
       
        try {
            if ("POST" === $request->getMethod()) {
                $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
                
                if($session != null){
                    $session->unset(UserInterface::class);
                }
               

                $post = $request->getParsedBody();
                $username = $post["username"];
                $password = $post["password"];
                $authResponse = $this->authAdapter->authenticate($username, $password);
                if($authResponse != null){
                    return new RedirectResponse("/dashboard");
                }else{
                    return new HtmlResponse($this->renderer->render(
                        'authentication::login',
                        [
                            "layout" => "login_layout::default",
                            "error"=>"Login Error"
                        ] // parameters to pass to template
                    ));
                }
            }
        } catch (\Throwable $th) {
            return new HtmlResponse($this->renderer->render(
                'authentication::login',
                [
                    "layout" => "login_layout::default",
                    "error"=>$th->getMessage()
                ] // parameters to pass to template
            ));
        }


        return new HtmlResponse($this->renderer->render(
            'authentication::login',
            [
                "layout" => "login_layout::default"
            ] // parameters to pass to template
        ));
    }
}
