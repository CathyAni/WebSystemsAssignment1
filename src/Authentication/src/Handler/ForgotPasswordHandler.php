<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Authentication\Entity\User;
use Doctrine\ORM\EntityManager;
use General\Service\GeneralService;
use General\Service\MailService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Flash\FlashMessageMiddleware;
use Mezzio\Template\TemplateRendererInterface;

class ForgotPasswordHandler implements RequestHandlerInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var GeneralService
     */
    private $generalService;

    /**
     * @var MailService
     */
    private $mailService;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer, EntityManager $em, MailService $mailService, GeneralService $generalService)
    {
        $this->renderer = $renderer;
        $this->entityManager = $em;
        $this->mailService = $mailService;
        $this->generalService = $generalService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $flashMessanger = $request->getAttribute(FlashMessageMiddleware::FLASH_ATTRIBUTE);
        if ("POST" == $request->getMethod()) {
            $post = $request->getParsedBody();
            if ($post["forgotpassword"] == null) {
                $flashMessanger->flash("danger", "You must fill the input field");
            } else {
                $em = $this->entityManager;
                /**
                 * @var User
                 */
                $data = $em->getRepository(User::class)->findOneBy([
                    "email" => $post["forgotpassword"]
                ]);
                $link = $this->generalService->absoluteUrl("authentication.recover.password", ["code" => $data->getActivationCode()]);
                // if($data == null){
                //     $flashMessanger->flash("danger", )
                // }
                // $reset_link = 
                $mailData["to"] = [$data->getEmail()];
                $mailData["subject"] = "AIB :: Reset Password";
                $mailData["params"] = [
                    "activation_link" => $link,

                ];
                $flashMessanger->flash("success", "Please check you email for, reset link");
                // $activateionCode = "";
                $this->mailService->sendMails($mailData, "authentication_email::confirm_email");
                return new RedirectResponse("/forgot-password");
            }
        }
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'authentication::forgot-password',
            [
                "layout" => "login_layout::default",
            ] // parameters to pass to template
        ));
    }
}
