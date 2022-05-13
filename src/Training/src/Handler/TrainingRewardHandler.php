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
use Training\Entity\TrainingReward;

class TrainingRewardHandler implements RequestHandlerInterface
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

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        // Do some work...
        // Render and return a response:
        // return new HtmlResponse($this->renderer->render(
        //     'training::training-reward',
        //     [] // parameters to pass to template
        // ));
        $trainingId = $request->getAttribute("trainingUid");
        $user = $request->getAttribute(UserInterface::class);
        $em = $this->entityManager;

        $repo = $em->getRepository(TrainingReward::class);
        $reward = $repo->createQueryBuilder("r")
            ->select("r")
            ->where("r.user = :user")
            ->andWhere("r.training = :train")
            ->setParameters([
            "user" => $user->getDetails()["id"],
            "train" => $trainingId
        ])
            ->getQuery()
            ->getResult();
            $result = ($reward == null ? true : false);
        return new JsonResponse([
            "data" => $result

        ], 200);
    }
}
