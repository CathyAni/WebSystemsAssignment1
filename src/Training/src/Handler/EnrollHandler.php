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
use Mezzio\Session\SessionMiddleware;
use Mezzio\Template\TemplateRendererInterface;
use Training\Service\ClassRoomService;

class EnrollHandler implements RequestHandlerInterface
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
     * @var ClassRoomService
     */
    private $classroomService;

    public function __construct(TemplateRendererInterface $renderer, EntityManager $entityManager, ClassRoomService $classRoomService)
    {
        $this->renderer = $renderer;
        $this->entityManager = $entityManager;
        $this->classroomService = $classRoomService;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $em = $this->entityManager;
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        $trainingUid = $request->getAttribute("trainingUid");

        $user = $request->getAttribute(UserInterface::class);

        if($trainingUid != NULL){
            $trainingEntity = $em->getRepository(Training::class)->findOneBy([
                "trainingUid" => $trainingUid
            ]);
            
            try {
                $trainingId = $trainingEntity->getId();
                $session->set("trainingId", $trainingEntity->getId());
                $enrollment = $this->classroomService->enrollment($trainingId,  $user->getDetails()["id"]);
                if($enrollment){
                    return new JsonResponse([
                        "trainingUid" => $trainingEntity->getTrainingUid()
                    ], 201);

                }else{
                    return new JsonResponse([], 510);
                }
                //code...
            } catch (\Throwable $th) {
                //throw $th;
                return new JsonResponse([], 422);
            }
        }
        // Do some work...
        // Render and return a response:
        // return new HtmlResponse($this->renderer->render(
        //     'training::enroll',
        //     [] // parameters to pass to template
        // ));

        
    }
}
