<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Training\Entity\Training;

class TrainingAllHandler implements RequestHandlerInterface
{
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
        $trainings = $em->createQueryBuilder()->select(array(
            "t",
            "tm"
        ))
            ->from(Training::class, "t")
            ->join("t.image", "tm")
            // ->setFirstResult($offset)
            ->where("t.isPublished = :pub")->setParameters([
                "pub" => TRUE
            ])
            // ->setMaxResults($itemCountPerPage)
            ->orderBy("t.id", "DESC")->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return new HtmlResponse($this->renderer->render(
            'training::training-all',
            [
                "trainings" => $trainings
            ] // parameters to pass to template
        ));
    }
}
