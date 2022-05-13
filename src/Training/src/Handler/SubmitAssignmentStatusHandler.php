<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Training\Entity\UserTraining;

class SubmitAssignmentStatusHandler implements RequestHandlerInterface
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
        // Do some work...
        // Render and return a response:
        // return new HtmlResponse($this->renderer->render(
        //     'training::submit-assignment-status',
        //     [] // parameters to pass to template
        // ));
        $trainingId  = $request->getAttribute("trainingUid");
        $user = $request->getAttribute(UserInterface::class);
        $em = $this->entityManager;
        $repo = $em->getRepository(UserTraining::class);

        $userTrainingEntity = $repo->findOneBy([
            "user" => $user->getDetails()["id"],
            "training" => $trainingId
        ]);

        // $srepo = $em->getRepository(AdminSubmittedAssignment::class)->findOneBy([
        //     "userTraining" => $userTrainingEntity->getId()
        // ]);
        return new JsonResponse([], 200);
    }
}
