<?php
namespace IMServices\Form\Fieldset;

use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class GroupLifeBenficiaryFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

   public function init(){
       
   }

    /**
     * (non-PHPdoc)
     *
     * @see \Laminas\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        
        return array();
    }
    
    private function setEntityManager($em){
        $this->entityManager = $em;
        return  $this;
    }
    
}

