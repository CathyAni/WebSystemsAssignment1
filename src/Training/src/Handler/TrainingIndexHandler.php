<?php

declare(strict_types=1);

namespace Training\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Authentication\UserInterface;
use Mezzio\Template\TemplateRendererInterface;
use Training\Service\TrainingService;

class TrainingIndexHandler implements RequestHandlerInterface
{

    /**
     * 
     */
    private $trainingService;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer, TrainingService $trainingService)
    {
        $this->renderer = $renderer;
        $this->trainingService = $trainingService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $trainingService = $this->trainingService;
        $user = $request->getAttribute(UserInterface::class);
        
        $trainingService->setUserId($user->getDetails()["id"]);
        $progress = $trainingService->getInProgressTraining();
        $recenttrainig = $trainingService->getMostRecentTraining();
        
        return new HtmlResponse($this->renderer->render(
            'training::training-index',
            [
                "inProgress" => $progress,
                "recentTraining" => $recenttrainig
            ] // parameters to pass to template
        ));
    }
}
