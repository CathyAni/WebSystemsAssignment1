<?php
namespace Claims\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Claims\Form\Fieldset\ClaimsContractorAllRiskFieldset;

class ClaimsContractorAllRiskFieldsetFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $fieldset = new ClaimsContractorAllRiskFieldset();
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}

