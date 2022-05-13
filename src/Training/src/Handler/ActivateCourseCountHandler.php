<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Authentication\UserInterface;
use Mezzio\Template\TemplateRendererInterface;
use Training\Entity\UserTraining;

class ActivateCourseCountHandler implements RequestHandlerInterface
{

    /**
     * 
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

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $em = $this->entityManager;
        $user = $request->getAttribute(UserInterface::class);
        $trainingId = $request->getAttribute("trainingUid");

        $repo = $em->getRepository(UserTraining::class);

        /**
         *
         * @var UserTraining $userTraining
         */
        $userTraining = $repo->createQueryBuilder("t")
            ->select([
            "t",
            "ca"
        ])
            ->leftJoin("t.courseActivity", "ca")
            ->where("t.user = :user")
            ->andWhere("t.training = :train")
            ->setParameters([
            "user" => $user->getDetails()["id"],
            "train" => $trainingId
        ])
            ->getQuery()
            ->getResult();
            $count = ($userTraining == NULL ? 0 : count($userTraining[0]->getCourseActivity()));
        return new JsonResponse([
            "count" => $count
        ], 200);
    }
}
