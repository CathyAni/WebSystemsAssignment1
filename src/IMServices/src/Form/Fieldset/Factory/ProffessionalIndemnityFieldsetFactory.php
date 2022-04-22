<?php
namespace IMServices\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\Fieldset\ProffesionalIndemnityFieldset;


/**
 *
 * @author otaba
 *        
 */
class ProffessionalIndemnityFieldsetFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Laminas\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $fieldset = new ProffesionalIndemnityFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $fieldset->setEntityManager($generalService->getEntityManager());
        return $fieldset;
    }
}

