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
use Training\Entity\Course;
use Training\Entity\UserCourseActivity;
use Training\Entity\UserTraining;

class RoomCourseActivityHandler implements RequestHandlerInterface
{
    /**
     * @var 
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
        if($request->getMethod() === "POST"){
            $post = $request->getParsedBody();
            // $userId 
            $courseId = $post["courseId"];
            $trainingId = $post["trainingId"];
            $userCourseActivity = $em->getRepository(UserCourseActivity::class)->findOneBy([
                "user" => $user->getDetails()["id"],
                "course" => $courseId
            ]);

            if($userCourseActivity == NULL){
                try {
                    $userTrainingEntity = $em->getRepository(UserTraining::class)->findOneBy([
                        "training" => $trainingId,
                        "user" => $user->getDetails()["id"],
                    ]);

                    $courseActivity = new UserCourseActivity();
                    $courseActivity->setCourse($em->find(Course::class, $courseId))
                        ->setUserTraining($userTrainingEntity)
                        ->setCreatedOn(new \DateTime())
                        ->setUser($user);
                    
                    $em->persist($courseActivity);
                    $em->flush();

                    return new JsonResponse([], 201);
                } catch (\Throwable $th) {
                    //throw $th;
                    return new JsonResponse([
                        "messages"=>"Something went wrong"
                    ], 500);

                }
            }
        }

        
        // Do some work...
        // Render and return a response:
        // return new HtmlResponse($this->renderer->render(
        //     'training::room-course-activity',
        //     [] // parameters to pass to template
        // ));

        return new JsonResponse([]);
    }
}
