<?php

declare(strict_types=1);

namespace Women\Handler;

use Authentication\Entity\User;
use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Doctrine\ORM\EntityManager;
use Women\Entity\Event;

class CreateEventHandler implements RequestHandlerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer, $em)
    {
        $this->renderer = $renderer;
        $this->entityManager = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $em = $this->entityManager;
        try {
            if ("POST" === $request->getMethod()) {
                $post = $request->getParsedBody();
                $eventEntity = new Event();
                $desc = strip_tags($post["event_desc"]);
                $name = strip_tags($post["event_name"]);
                // $startdate = new Datetime($post["start_date"]);
                $eventEntity
                    ->setEventDecsription($desc)
                    ->setCreatedAt(new DateTime("now"))
                    ->setEventName($name)->set;
                    
                // ->setCreator($em->find(User::class, $id))
                // ->setStartDate($startdate);

                $em->persist($eventEntity);
                $em->flush();
            }
        } catch (\Throwable $th) {
            return new JsonResponse([
                "error" => $th->getMessage()
            ]);
        }




        return new JsonResponse([
            "status" => "success"
        ], 201);
    }
}
