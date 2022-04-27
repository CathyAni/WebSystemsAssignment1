<?php

declare(strict_types=1);

namespace Authentication;

use Authentication\Adapter\AuthenticationAdapter;
use Authentication\Adapter\AuthenticationAdapterFactory;
use Authentication\Form\Fieldset\UserFieldset;
use Authentication\Form\Fieldset\UserFieldsetFactory;
use Authentication\Handler\LoginHandler;
use Authentication\Handler\LoginHandlerFactory;
use Authentication\Middleware\AuthenticationMiddleware;
use Authentication\Middleware\AuthenticationMiddlewareFactory;
use Authentication\Middleware\UserRedirectMiddleware;
use Authentication\Middleware\UserRedirectMiddlewareFactory;
use Authentication\Service\AuthenticationInterface;
use Authentication\Service\UserService;
use Authentication\Service\UserServiceFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Laminas\ServiceManager\Factory\InvokableFactory;
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
            "form_elements"=>$this->getFormElements(),
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
            'invokables' => [
                AuthenticationInterface::class=>AuthenticationInterface::class,
            ],
            'factories'  => [
                AuthenticationMiddleware::class=>AuthenticationMiddlewareFactory::class,
                AuthenticationAdapter::class=>AuthenticationAdapterFactory::class,

                UserRedirectMiddleware::class=>UserRedirectMiddlewareFactory::class,

                //Services
                UserService::class=>UserServiceFactory::class,

                //handlers 
                LoginHandler::class=>LoginHandlerFactory::class,
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
                "authentication_partial"=>[__DIR__ . '/../templates/partial'],
                "authentication_email"=>[__DIR__ . '/../templates/email'],
            ],
        ];
    }

    public function getFormElements(){
        return [
            "factories"=>[
                UserFieldset::class=>UserFieldsetFactory::class
            ]
        ];
    }
}
