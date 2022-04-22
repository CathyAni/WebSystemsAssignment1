<?php
namespace IMServices\Form;

use Laminas\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class MotorNonStandardForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method" => "POST",
            "class" => "form-horizontal form-label-left",
            "data-ajax-loader"=>"micro_processing",
            
        ));
        
        $this->add(array(
            "name" => "motorNonStandardFieldset",
            "type" => "IMServices\Form\Fieldset\MotorNonStandardAccesoryFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Laminas\Form\Element\Submit',
            'attributes' => array(
               
                'value' => 'Add Info',
                'class' => 'btn btn-xs btn-success btn-block'
            )
        ));
    }
    
    
}

