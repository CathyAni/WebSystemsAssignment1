<?php
namespace Claims\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Claims\Form\Fieldset\ClaimsDriverDetailsFieldset;

/**
 *
 * @author otaba
 *        
 */
class ClaimsDriverDetailsFactory implements FactoryInterface
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
        $field = new ClaimsDriverDetailsFieldset();
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $field->setEntityManager($em);
        return $field;
    }
}
