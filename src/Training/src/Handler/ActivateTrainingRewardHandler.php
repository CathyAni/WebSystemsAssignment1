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
use Training\Service\YoutubeApiService;
use Training\Entity\Training;
use Training\Entity\UserTraining;
use Training\Service\TrainingService;

class ActivateTrainingRewardHandler implements RequestHandlerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var 
     */
    private $youtubeService;

    public function __construct(TemplateRendererInterface $renderer, EntityManager $entityManager, YoutubeApiService $youtubeService)
    {
        $this->renderer = $renderer;
        $this->entityManager = $entityManager;
        $this->youtubeService = $youtubeService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $em = $this->entityManager;
        $user = $request->getAttribute(UserInterface::class);
        $youtubeApiService = $this->youtubeService;
        if ($request->getMethod() === "POST") {
            $post = $request->getParsedBody();
            $trainingId = $request->getAttribute("trainingUid");

            $trainingReward = $em->getRepository(TrainingReward::class)->findOneBy([
                "training" => $trainingId,
                'user' => $user->getDetails()["id"]
            ]);

            if ($trainingReward !== NULL) {
                return new JsonResponse([
                    "messages" => "You have been rewarded for this training"
                ], 200);
            } else {
                try {
                    /**
                     *
                     * @var Training $trainingEntity
                     */
                    $trainingEntity = $em->find(Training::class, $trainingId);
                    $trainingRewardEntity = new TrainingReward();
                    $trainingRewardEntity->setCreatedOn(new \DateTime())
                        ->setTraining($trainingEntity)
                        ->setUser($user);

                    /**
                     *
                     * @var UserTraining $userTrainingEntity
                     */
                    $userTrainingEntity = $em->getRepository(UserTraining::class)->findOneBy([
                        "user" => $user->getDetails()["id"],
                        "training" => $trainingEntity->getId()


                    ]);


                    $userTrainingEntity->setEndDate(new \DateTime())
                        ->setStatus($em->find(TrainingStatus::class, TrainingService::TRAINING_STATUS_COMPLETED))
                        ->setUpdatedOn(new \DateTime());



                    $youtube = $youtubeApiService->process($userTrainingEntity);

                    if ($youtube["isEligible"]) {
                        $em->persist($trainingRewardEntity);
                        $em->persist($userTrainingEntity);

                        $em->flush();
                    } else {
                        $trainingRewardEntity = new TrainingReward();
                        $trainingRewardEntity->setCreatedOn(new \DateTime())
                            ->setTraining($trainingEntity)
                            ->setUser($user);

                        $em->persist($trainingRewardEntity);
                        $em->flush();

                        return new JsonResponse([
                            "messages" => "Ohhhh No !!!, Our system detects you have not conformed to the activity requirements of this course, you are not eligible"
                        ], 401);
                    }
                } catch (\Throwable $th) {
                    return new JsonResponse([
                        "messages" => "We could not process your reward at this time",
                        "data" => $th->getTrace()
                    ], 500);
                }
            }
        }

        // Do some work...
        // Render and return a response:
        return new JsonResponse([]);
    }
}
