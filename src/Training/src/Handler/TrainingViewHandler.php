<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Authentication\UserInterface;
use Mezzio\Template\TemplateRendererInterface;
use Training\Entity\Training;

class TrainingViewHandler implements RequestHandlerInterface
{
    private $entityManager;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer, EntityManager $entityManager)
    {
        $this->renderer = $renderer;
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $em = $this->entityManager;
        $id = $request->getAttribute("id");
        $user = $request->getAttribute(UserInterface::class);
        if(isset($id) == NULL){
            return new RedirectResponse("/training/all");
        }

        $trainingEntity = $em->getRepository(Training::class)->findOneBy([
            "trainingUid" => strip_tags($id)
        ]);

        if($trainingEntity == NULL){
            return new RedirectResponse("/training/all");
        }


        return new HtmlResponse($this->renderer->render(
            'training::training-view',
            [
                "training" => $trainingEntity,
                "user"=>$user
            ] // parameters to pass to template
        ));
    }
}
