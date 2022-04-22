<?php

declare(strict_types=1);

namespace Authentication;


use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Mezzio\Application;

/**
 * The configuration provider for the Authentication module
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
                    RouteDelegator::class
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
                        'Authentication\Entity' => 'authentication_entity',
                    ],
                ],
                'authentication_entity' => [
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
                'authentication'    => [__DIR__ . '/../templates/'],
                'login_layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
