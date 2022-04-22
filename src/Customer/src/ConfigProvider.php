<?php

declare(strict_types=1);

namespace Customer;

use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Mezzio\Application;

/**
 * The configuration provider for the Customer module
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
                        __NAMESPACE__.'\Entity' => __NAMESPACE__.'_entity',
                    ],
                ],
                __NAMESPACE__.'_entity' => [
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
                'customer'    => [__DIR__ . '/../templates/']
                // "customer_partials_menu"=>[__DIR__ . '/../templates/partial/'],
            ],
            "map" => [
                'customer_partials_menu' => __DIR__ . '/../templates/partial/customer_menu.phtml',
                // 'topbar_partials' => __DIR__ . '/../templates/layout/partials/topbar.phtml',
            ]
        ];
    }
}
