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
use Training\Service\ClassRoomService;

class GetProgrammesHandler implements RequestHandlerInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    private $classroomService;

    public function __construct(TemplateRendererInterface $renderer, EntityManager $entityManager, ClassRoomService $classroomService)
    {
        $this->renderer = $renderer;
        $this->entityManager = $entityManager;
        $this->classroomService = $classroomService;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $em = $this->entityManager; 
        $trainingUid = $request->getAttribute("trainingUid");
        if($trainingUid != NULL){
            $programmes = $this->classroomService->getClassroomProgrammes($trainingUid);
            return new JsonResponse([
                "programmes" => $programmes
            ], 200);
        }else{
            return new JsonResponse([], 423);
        }
        // Do some work...
        // Render and return a response:
        // return new HtmlResponse($this->renderer->render(
        //     'training::get-programmes',
        //     [] // parameters to pass to template
        // ));

       
        
    }
}
