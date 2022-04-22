<?php
namespace Claims\Form;

use Laminas\Form\Form;

class ClaimsFireLossForm extends Form
{

    public function init(){
        
        $this->setAttributes(array(
            "method"=>"POST"
        ));
        $this->add(array(
            'name'=>'claimsfireLossFieldset',
            'type'=>'Claims\Form\Fieldset\ClaimsFireLossFieldset',
            'options'=>array(
                'use_as_base_fieldset'=>true
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Laminas\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Complete Claims',
                'class' => 'btn btn-success btn-block', // col-lg-offset-2
                //                 'id' => 'create-object'
            )
        ));
    }
}

