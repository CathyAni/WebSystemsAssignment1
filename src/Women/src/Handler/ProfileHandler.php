<?php

declare(strict_types=1);

namespace Women\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Women\Entity\Profile;
use Mezzio\Template\TemplateRendererInterface;
use Authentication\Entity\User;
class ProfileHandler implements RequestHandlerInterface
{
        /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->entityManager = '$em';
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $em = $this->entityManager;
        try {
            if ("POST" === $request->getMethod()) {
                $post = $request->getParsedBody();
                $profileEntity = new Profile();
                $dob = strip_tags($post["profile_dob"]);
                $name = strip_tags($post["profile_name"]);
                $profileEntity
                ->setProfileDob($dob)
                ->setCreatedAt(new DateTime("now"))
                ->setProfileName($name)

            $em->persist($profileEntity);
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
