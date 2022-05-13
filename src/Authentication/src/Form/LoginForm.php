<?php

namespace Authentication\Form;

use Laminas\Form\Form;

class LoginForm extends Form
{


    public function init()
    {
        $this->setAttributes([
            'action' => '/login',
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left',
        ]);

        $this->add(array(
            'name' => 'userFieldset',
            'type' => UserFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Laminas\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Register',
                'class' => 'btn btn-success btn-block',

            )
        ));
    }
}
