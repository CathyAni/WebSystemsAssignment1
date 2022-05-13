<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Training\Entity\Training;

class GetAllTrainingHandler implements RequestHandlerInterface
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
        $data = $em->getRepository(Training::class)->findBy([
            "isPublished" => TRUE
        ]);
        return new HtmlResponse($this->renderer->render(
            'training::get-all-training',
            [
                "data" => $data
            ] // parameters to pass to template
        ));
    }
}
