<?php
namespace IMServices\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\Fieldset\MarineCargoFieldset;


/**
 *
 * @author otaba
 *        
 */
class MarineCargoFieldsetFactory implements FactoryInterface
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
        
        $form = new MarineCargoFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $form->setEntityManager($generalService->getEntityManager());
        return $form;
    }
}

