<?php

declare(strict_types=1);

namespace Authentication\Adapter;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class  AuthenticationAdapterFactory
{


    public function __invoke(ContainerInterface $container)
    {
        if (!$container->has(EntityManager::class)) {
            throw new \Exception('EntityManager not found.');
        }

        /** @var array $config */
        $config = $container->get('config');
        if (!isset($config['doctrine']['authentication'])) {
            throw new \Exception('Authentication config not found.');
        }
        return new AuthenticationAdapter($container->get(EntityManager::class), $config['doctrine'],  $container->get(UserInterface::class));
    }
}
