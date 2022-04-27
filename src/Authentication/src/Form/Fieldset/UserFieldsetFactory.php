<?php

declare(strict_types=1);


namespace Authentication\Form\Fieldset;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class UserFieldsetFactory{

    public function __invoke(ContainerInterface $container)
    {
    
        $fieldset = new UserFieldset();
        $em = $container->get(EntityManager::class);
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}