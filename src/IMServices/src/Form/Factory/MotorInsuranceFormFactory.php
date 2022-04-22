<?php
namespace IMServices\Form\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\MotorInsuranceForm;


/**
 *
 * @author otaba
 *        
 */
class MotorInsuranceFormFactory implements FactoryInterface
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
        
        $form = new MotorInsuranceForm();
        return $form;
    }
}

