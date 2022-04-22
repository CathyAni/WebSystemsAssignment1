<?php

declare(strict_types=1);

namespace Documents;

use Mezzio\Application;
use Documents\RouteDelegator;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;

/**
 * The configuration provider for the Documents module
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
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            "doctrine" => $this->getDoctrineEntities(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            "delegators" => [
                Application::class => [
                    RouteDelegator::class,
                ]
            ],
            'invokables' => [],
            'factories'  => [],
           
        ];
    }

    public function getDoctrineEntities() : array
    {
        return [
            'driver' => [
                'orm_default' => [
                    'class' => MappingDriverChain::class,
                    'drivers' => [
                        'Documents\Entity' => 'doc_entity',
                    ],
                ],
                'doc_entity' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [__DIR__ . '/Entity'],
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'documents'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
