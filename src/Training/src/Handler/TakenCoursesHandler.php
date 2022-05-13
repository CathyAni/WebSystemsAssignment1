<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Authentication\UserInterface;
use Mezzio\Template\TemplateRendererInterface;
use Training\Entity\UserCourseActivity;
use Training\Entity\UserTraining;

class TakenCoursesHandler implements RequestHandlerInterface
{

    /**
     * @var EntityManager
     */
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

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $em = $this->entityManager;
        $trainingId = $request->getAttribute("trainingUid");
        $user = $request->getAttribute(UserInterface::class);
        try {
            $userTrainingEntity = $em->getRepository(UserTraining::class)->findOneBy([
                "training" => $trainingId,
                "user" => $user->getDetails()["id"]
            ]);

            $repo = $em->getRepository(UserCourseActivity::class);
            $takenCourses = $repo->createQueryBuilder("c")
                ->select([
                    "c",
                    "co"
                ])
                ->where("c.userTraining = :training")
                ->leftJoin("c.course", "co")
                ->setParameters([
                    "training" => $userTrainingEntity->getId()
                ])
                ->getQuery()
                ->getResult(Query::HYDRATE_ARRAY);

            return new JsonResponse([
                "taken" => $takenCourses
            ]);
        } catch (\Throwable $th) {
            return new JsonResponse([
                "messages" => "Something went wrong",
                "data" => $th->getMessage()
            ]);
            //throw $th;
        }
        // Do some work...
        // Render and return a response:
        // return new HtmlResponse($this->renderer->render(
        //     'training::taken-courses',
        //     [] // parameters to pass to template
        // ));

    }
}
