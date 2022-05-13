<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Authentication\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Flash\FlashMessageMiddleware;
use Mezzio\Template\TemplateRendererInterface;

class ConfirmEmailHandler implements RequestHandlerInterface
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer, EntityManager $entityManager)
    {
        $this->renderer = $renderer;
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Do some work...
        // Render and return a response:
        $code = $request->getAttribute("code") ?? null;
        $flashMessenger = $request->getAttribute(FlashMessageMiddleware::FLASH_ATTRIBUTE);
        if ($code == null) {
            $flashMessenger->flash("danger", "An Activation Code is Required");
        } else {
            $em = $this->entityManager;
            /**
             * @var User
             */
            $userEntity = $em->getRepository(User::class)->findOneBy(["activationCode"=>$code]);
            if ($userEntity == null) {
                $flashMessenger->flash("danger", "We do not believe this code is active");
            } else {

                if ($userEntity->getEmailConfirmed()) {
                    $flashMessenger->flash("danger", "Account already Confirmed");
                } else {
                    $userEntity->setEmailConfirmed(TRUE)->setIsActive(True)->setUpdatedOn(new DateTime())->setActivationCode(bin2hex(openssl_random_pseudo_bytes(18)));
                    $em->persist($userEntity);
                    $em->flush();
                    $flashMessenger->flash("success", "Email successfully confirmed Please login");
                }
            }
        }
        return new RedirectResponse("/login");
    }
}
