<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class GetUserTrainingSubmitStatusHandlerFactory
{
    public function __invoke(ContainerInterface $container) : GetUserTrainingSubmitStatusHandler
    {
        return new GetUserTrainingSubmitStatusHandler($container->get(TemplateRendererInterface::class));
    }
}
