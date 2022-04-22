<?php

declare(strict_types=1);

namespace Proparty;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Mezzio\Application;

/**
 * The configuration provider for the Proparty module
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

            'doctrine' => array(
                'driver' => array(
                    __NAMESPACE__ . '_entity' => [
                        'class' => AnnotationDriver::class,
                        'cache' => 'array',
                        'paths' => [
                            __DIR__ .  '/../src/' . __NAMESPACE__ . '/Entity'
                        ]
                    ],
                    'orm_default' => [
                        'drivers' => [
                            "class"=>MappingDriverChain::class,
                            __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_entity'
                        ]
                    ]
                )
            )
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'proparty'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
