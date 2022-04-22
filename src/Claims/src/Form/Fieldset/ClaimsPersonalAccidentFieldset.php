<?php
namespace Claims\Form\Fieldset;

use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class ClaimsPersonalAccidentFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init(){
        
    }
    
    private function addFields(){
        $this->add(array(
            "name"=>""
        ));
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Laminas\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {}
}

