<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Authentication\Form\UserForm;
use Authentication\Service\UserService;

class CreateUserHandler implements RequestHandlerInterface
{

    /**
     * @var UserForm
     */
    private $registerForm;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    // private $generalService;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(TemplateRendererInterface $renderer, UserForm $form, UserService $userService)
    {
        $this->renderer = $renderer;
        $this->registerForm = $form;
        $this->userService = $userService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $form = $this->registerForm;
        $error = null;
        $form->setAttributes(
            [
                "method" => "POST",
                "action" => "/register",
                "autocomplete"=>"off"
            ]
        );
        if ("POST" === $request->getMethod()) {
            $post = $request->getParsedBody();
            
            $form->setValidationGroup([
                "userFieldset" => [
                    "username",
                    "email",
                    "password",
                    "passwordVerify",
                    "terms"
                ]

            ]);
            $form->setData($post);
            if ($form->isValid()) {
                try {
                    $data = $form->getData();
                    $this->userService->createDefaultUserasCustomer($data);
                    return new HtmlResponse($this->renderer->render("authentication::success-registration"), 201);
                } catch (\Throwable $th) {
                    
                }
            }else{
               $error = "Invalid Submittion ";
            }
        }


        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'authentication::create-user',
            [
                "error"=>$error,
                "layout" => "login_layout::default",
                "form" => $form,
                
            ] // parameters to pass to template
        ));
    }

    /**
     * Set the value of userService
     *
     * @return  self
     */
    public function setUserService($userService)
    {
        $this->userService = $userService;

        return $this;
    }
}
