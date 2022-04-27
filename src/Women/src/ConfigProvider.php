<?php

declare(strict_types=1);

namespace Women;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Women\Handler\CreateEventHandler;
use Women\Handler\CreateEventHandlerFactory;
use Women\Handler\CreateStoryHandler;
use Women\Handler\CreateStoryHandlerFactory;
use Women\Handler\ProfileHandler;
use Women\Handler\ProfileHandlerFactory;
use Women\Handler\ShowProfileFormHandler;
use Women\Handler\ShowProfileFormHandlerFactory;
use Women\Handler\ShowStoryFormHandler;
use Women\Handler\ShowStoryFormHandlerFactory;

/**
 * The configuration provider for the Women module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            "doctrine"=>$this->getDoctrineEntities()
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                CreateEventHandler::class=>CreateEventHandlerFactory::class,
                ShowProfileFormHandler::class=>ShowProfileFormHandlerFactory::class,
                ProfileHandler::class=>ProfileHandlerFactory::class,

                CreateStoryHandler::class =>CreateStoryHandlerFactory::class,
                ShowStoryFormHandler::class=>ShowStoryFormHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'women'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    public function getDoctrineEntities() : array
    {
        return [
            'driver' => [
                'orm_default' => [
                    'class' => MappingDriverChain::class,
                    'drivers' => [
                        'Women\Entity' => 'women_entity',
                    ],
                ],
                'women_entity' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [__DIR__ . '/Entity'],
                ],
            ],
        ];
    }
}
