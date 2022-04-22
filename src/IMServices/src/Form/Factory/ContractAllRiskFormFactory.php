<?php
namespace IMServices\Form\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\ContractAllRiskForm;

/**
 *
 * @author otaba
 *        
 */
class ContractAllRiskFormFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Laminas\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new ContractAllRiskForm();
        return $form;
    }
}

