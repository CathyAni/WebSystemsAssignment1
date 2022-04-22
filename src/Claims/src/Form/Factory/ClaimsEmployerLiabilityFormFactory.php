<?php
namespace Claims\Form\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Claims\Form\ClaimsEmployerLiabilityForm;

class ClaimsEmployerLiabilityFormFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $form = new ClaimsEmployerLiabilityForm();
        return $form;
    }
}

