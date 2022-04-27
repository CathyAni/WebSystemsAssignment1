<?php

namespace Authentication\Form;

use Authentication\Form\Fieldset\UserFieldset;
use Laminas\Form\Form;

class UserForm extends Form
{

    public function init()
    {
        $this->setAttributes([
            'action' => '/register',
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

        // $this->add(array(
        //     'name' => 'csrf',
        //     'type' => 'Laminas\Form\Element\Csrf',
        //     'options' => array(
        //         'csrf_options' => array(
        //             'timeout' => 1400
        //         )
        //     )
        // ));
        $this->add(array(
            'name' => 'reset',
            'type' => 'Laminas\Form\Element',
            'options' => array(),
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => 'Reset',
                'id' => 'reset'
            )
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
