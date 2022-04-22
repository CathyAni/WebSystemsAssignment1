<?php
namespace IMServices\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\Fieldset\OccupiersLiabilityFamiliyFieldset;


/**
 *
 * @author otaba
 *        
 */
class OccupiersLiabilityFamiliyFieldsetFactory implements FactoryInterface
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
        
        $fieldset = new OccupiersLiabilityFamiliyFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $fieldset->setEntityManager($generalService->getEntityManager());
        
        return $fieldset;
    }
}

