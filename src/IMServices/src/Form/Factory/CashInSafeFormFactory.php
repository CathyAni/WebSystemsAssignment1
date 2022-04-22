<?php
namespace IMServices\Form\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\CashInSafeForm;


/**
 *
 * @author otaba
 *        
 */
class CashInSafeFormFactory implements FactoryInterface
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
        
        $form = new CashInSafeForm();
        return $form;
    }
}

