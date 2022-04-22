<?php
namespace IMServices\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\Fieldset\FidelityGuarateeFieldset;


/**
 *
 * @author otaba
 *        
 */
class FidelityGuarateeFieldsetFactory implements FactoryInterface
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
        
       $fieldset = new FidelityGuarateeFieldset();
       $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
       $fieldset->setEntityManager($generalService->getEntityManager());
       return $fieldset;
    }
}
