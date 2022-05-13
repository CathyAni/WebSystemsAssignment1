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
use Mezzio\Session\SessionMiddleware;
use Mezzio\Template\TemplateRendererInterface;
use Training\Service\ClassRoomService;

class RoomHandler implements RequestHandlerInterface
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

    public function __construct(TemplateRendererInterface $renderer, EntityManager $entityManager, ClassRoomService $classroomService)
    {
        $this->renderer = $renderer;
        $this->entityManager = $entityManager;
        $this->classroomService = $classroomService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Do some work...
        // Render and return a response:
        $trainingUid = $request->getAttribute("trainingUid");
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        $classroomService = $this->classroomService;
        $em = $this->entityManager;
        // if
        $classroomService->setClassroomSession($session);
        if (!$trainingUid != NULL) {

            /**
             *
             * @var Training $trainingEntity
             */
            $trainingEntity = $em->getRepository(Training::class)->findOneBy([
                "trainingUid" => strip_tags($trainingUid)
            ]);

            $user = $request->getAttribute(UserInterface::class);


            $data = $em->getRepository(UserTraining::class)->findOneBy([
                "training" => $trainingEntity->getId(),
                "user" => $user->getDetails()["id"]
            ]);
            if ($trainingEntity != NULL) {
                $session->set("trainingId", $trainingEntity->getId());
                return new HtmlResponse($this->renderer->render(
                    'training::room',
                    [
                        "tarining" => $trainingEntity,
                        "userTraining" => $data,
                    ] // parameters to pass to template
                ));
            } else {
                return new RedirectResponse("/training/all");
            }
        } else {
            return new RedirectResponse("/training/all");
        }
    }
}
