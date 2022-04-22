<?php
namespace IMServices\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\Fieldset\DirectorsLiabilityFieldset;


/**
 *
 * @author otaba
 *        
 */
class DirectorLiabilityFieldsetFactory implements FactoryInterface
{


    /**
     * (non-PHPdoc)
     *
     * @see \Laminas\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $fieldset = new DirectorsLiabilityFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $fieldset->setEntityManager($generalService->getEntityManager());
        return $fieldset;
    }
}

