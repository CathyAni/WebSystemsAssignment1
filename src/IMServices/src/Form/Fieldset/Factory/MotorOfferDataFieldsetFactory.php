<?php
namespace IMServices\Form\Fieldset\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\Fieldset\MotorOfferDataFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class MotorOfferDataFieldsetFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Laminas\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new MotorOfferDataFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $fieldset->setEntityManager($em);
        ;
        
        return $fieldset;
    }
}

?>