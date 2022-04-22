<?php
namespace Claims\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Claims\Form\Fieldset\ClaimsDefaultFieldset;

/**
 *
 * @author otaba
 *        
 */
class ClaimsDefaultFieldsetFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Laminas\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
      
       $fieldset = new ClaimsDefaultFieldset();
       $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
       $em = $clientGeneralService->getEntityManager();
       $fieldset->setEntityManager($em);
       return $fieldset;
    }
}

