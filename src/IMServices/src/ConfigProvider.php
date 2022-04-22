<?php

declare(strict_types=1);

namespace IMServices;

use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

/**
 * The configuration provider for the IMServices module
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
            'invokables' => [],
            'factories'  => [],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'im-services'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    public function getDoctrineEntities(): array
    {
        return [
            'driver' => [
                'orm_default' => [
                    'class' => MappingDriverChain::class,
                    'drivers' => [
                        __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_entity',
                    ],
                ],
                __NAMESPACE__ . '_entity' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [__DIR__ . '/Entity'],
                ],
            ],
        ];
    }
}
