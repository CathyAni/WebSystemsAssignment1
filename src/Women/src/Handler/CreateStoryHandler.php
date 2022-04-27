<?php

declare(strict_types=1);

namespace Women\Handler;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Women\Entity\Story;

class CreateStoryHandler implements RequestHandlerInterface
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
        if ($request->getMethod() === "POST") {
            try {
                $post = $request->getParsedBody();
                $story_header = $post["story_header"];
                $story_body = $post["story_body"];

                $storyEntity = new Story();
                $storyEntity
                    ->setStoryHeader($story_header)
                    ->setStoryBody($story_body)
                    ->setStoryUid(uniqid())
                    ->setCreatedAt(new DateTime());

                $em->persist($storyEntity);

                $em->flush();
            } catch (\Throwable $th) {
                return new JsonResponse([
                    "error" => $th->getMessage()
                ]);
            }
        }
        return new JsonResponse([
            "success" => "Created Story"
        ], 201);
    }
}
