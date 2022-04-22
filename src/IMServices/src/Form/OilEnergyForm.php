<?php
namespace IMServices\Form;

use Laminas\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class OilEnergyForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method" => "POST",
            "class" => "form-horizontal form-label-left"
        ));
        
        $this->add(array(
            "name" => "oilEnergyFieldset",
            "type" => "IMServices\Form\Fieldset\OilEnergyFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Laminas\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-lg btn-primary btn-block'
            )
        ));
    }
}

