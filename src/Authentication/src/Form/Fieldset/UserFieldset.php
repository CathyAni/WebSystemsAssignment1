<?php

declare(strict_types=1);

namespace Authentication\Form\Fieldset;

use Authentication\Entity\User;
use Doctrine\Laminas\Hydrator\DoctrineObject;
use DoctrineModule\Validator\NoObjectExists;
use Laminas\Form\Fieldset;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\Identical;
use Laminas\Validator\StringLength;
use Doctrine\ORM\EntityManager;
use Laminas\Form\Element\Checkbox;
use Laminas\Validator\Regex;

class UserFieldset extends Fieldset implements InputFilterProviderInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;




    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new User());

        $this->add(array(
            'name' => 'username',
            'type' => 'text',
            'options' => array(
                'label' => 'Phone Number',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'username',
                "placeholder" => "Phone Number",
                'required' => 'required',
                'title' => 'Provide phone number'
            )
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Laminas\Form\Element\Email',
            'options' => array(
                'label' => 'Staff Email',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'email',
                'required' => 'required',
                'class' => 'form-control',
                'title' => 'Provide Email accessible by the staff',
                'placeholder' => 'Email'
            )
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'Laminas\Form\Element\Password',
            'options' => array(
                'label' => 'Proposed Password',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'password',
                "placeholder" => "Password",
                'required' => 'required',
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'name' => 'passwordVerify',
            'type' => 'Laminas\Form\Element\Password',
            'options' => array(
                'label' => 'Confirm Password',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control ',
                "placeholder" => "Confirm Password",
                'id' => 'passwordVerify',
                'required' => 'required'
            )
        ));

        $this->add([
            "name" => "terms",
            "type" => Checkbox::class,
            'options' => [
                'label' => 'A checkbox',
                'use_hidden_element' => true,
                'checked_value' => 'yes',
                'unchecked_value' => 'no',
            ],
            'attributes' => [
                'value' => 'no',
                "required"=>"required",
                "id"=>"agreeTerms",
                "name"=>"terms"
            ],
        ]);


        // $this->add(array(
        //     'name' => 'usernameOrEmail',
        //     'type' => 'text',
        //     'options' => array(
        //         'label' => 'Username',
        //         'label_attributes' => array(
        //             'class' => ''
        //         )
        //     ),
        //     'attributes' => array(
        //         'class' => 'form-control col-md-9 col-xs-12',
        //         'id' => 'username',
        //         'required' => 'required',
        //         'title' => 'Provide Staffs phone number'
        //     )
        // ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            "password" => array(
                "required" => true,
                "allow_empty" => false,
                "filters" => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                "validators" => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 6,
                            'max' => 50,
                            "messages" => array(
                                StringLength::TOO_SHORT => "The password must be more than 6 characters",
                                StringLength::TOO_LONG => "This password is too long to memorize"
                            )
                        )
                    )
                )
            ),

            "passwordVerify" => array(
                "required" => true,
                "allow_empty" => false,
                "validators" => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 6,
                            'max' => 50,
                            "messages" => array(
                                StringLength::TOO_SHORT => "The password must be more than 6 characters",
                                StringLength::TOO_LONG => "This password is too long to memorize"
                            )
                        )
                    ),
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'password',
                            "messages" => array(
                                Identical::NOT_SAME => "The passwords are not identical"
                            )
                        )
                    )
                )
            ),
            'email' => array(
                'required' => true,
                'allow_empty' => false,
                'break_chain_on_failure' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/',
                            'messages' => array(
                                Regex::NOT_MATCH => 'Please provide a valid email address.'
                            )
                        ),
                        'break_chain_on_failure' => true
                    ),
                    array(
                        'name' => NoObjectExists::class,
                        'options' => array(
                            'use_context' => true,
                            "target_class" => User::class,
                            'object_repository' => $this->entityManager->getRepository(User::class),
                            'object_manager' => $this->entityManager,
                            'fields' => array(
                                'email'
                            ),
                            'messages' => array(

                                NoObjectExists::ERROR_OBJECT_FOUND => 'An account exist with this email'
                            )
                        )
                    ),
                    array(
                        'name' => 'Laminas\Validator\StringLength',
                        'options' => array(
                            'messages' => array(),
                            'min' => 3,
                            'max' => 256,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Email Too short',
                                StringLength::TOO_LONG => 'We dont think this is a genuine email'
                            )
                        ),

                        array(
                            'name' => 'EmailAddress',

                            'options' => array(

                                'messages' => array(
                                    EmailAddress::INVALID_FORMAT => 'Please check your email something is not right'
                                )
                            )
                        )
                    )

                )
            ),
            'username' => array(
                'required' => true,
                'allow_empty' => false,
                'break_chain_on_failure' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(

                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'use_context' => false,
                            "target_class" => User::class,
                            'object_repository' => $this->entityManager->getRepository(User::class),
                            'object_manager' => $this->entityManager,
                            'fields' => [
                                'username'
                            ],
                            'use_context' => true,
                            'messages' => array(
                                NoObjectExists::ERROR_OBJECT_FOUND => 'Someone else is registered with this phone number'
                            )
                        )
                    ),

                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 9,
                            'max' => 11,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Please insert the correct amount of digits',
                                StringLength::TOO_LONG => 'We dont think this is a genuine phone number'
                            )
                        )
                    )
                )
            )
        );
    }



    /**
     * Set the value of entityManager
     *
     * @return  self
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
