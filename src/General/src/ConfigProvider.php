<?php

declare(strict_types=1);

namespace General;

use AcMailer\Service\Factory\MailServiceAbstractFactory;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use General\Service\GeneralService;
use General\Service\GeneralServiceFactory;
use General\Service\MailService;
use General\Service\MailServiceFactory;


/**
 * The configuration provider for the General module
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
            'factories'  => [
                "acmailer.mailservice.live" => MailServiceAbstractFactory::class,
                MailService::class=>MailServiceFactory::class,
                GeneralService::class=>GeneralServiceFactory::class,
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
                        'General\Entity' => 'general_entity',
                    ],
                ],
                'general_entity' => [
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
                'general'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
