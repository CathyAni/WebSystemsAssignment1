<?php
namespace IMServices\Form\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\DirectorsLiabilityForm;


/**
 *
 * @author otaba
 *        
 */
class DirectorLiabiltiyFormFactory implements FactoryInterface
{

   

    /**
     * (non-PHPdoc)
     *
     * @see \Laminas\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new DirectorsLiabilityForm();
        return $form;
    }
}
