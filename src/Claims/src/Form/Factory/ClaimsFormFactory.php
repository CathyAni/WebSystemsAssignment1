<?php
namespace Claims\Form\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

use Claims\Form\ClaimsForm;

/**
 *
 * @author swoopfx
 *        
 */
class ClaimsFormFactory implements FactoryInterface
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
        
        $form = new ClaimsForm();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        return $form;
    }
}

