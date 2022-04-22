<?php
namespace IMServices\Form\Fieldset;

use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\GroupPersonalFixedDetails;

/**
 *
 * @author otaba
 *        
 */
class GroupPersonalFixedDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setObject(new GroupPersonalFixedDetails())->setHydrator($hydrator);

       
       $this->add(array(
           "name"=>"name",
           "type"=>"text",
           "options"=>array(
               "label"=>"Persons Name",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control",
               "id"=>"name"
           ),
       ));
       
       $this->add(array(
           "name"=>"dob",
           "type"=>"date",
           "options"=>array(
               "label"=>"Date Of Birth",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control",
               "id"=>"dob"
           ),
       ));
       
       $this->add(array(
           "name"=>"occupation",
           "type"=>"text",
           "options"=>array(
               "label"=>"Occupation",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control",
               "id"=>"occupation"
           ),
       ));
       
       $this->add(array(
           "name"=>"temporaryDisablementTotal",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total temporary disablement",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control",
               "id"=>"temporaryDisablementTotal"
           ),
       ));
       
       $this->add(array(
           "name"=>"permanentDisablement",
           "type"=>"text",
           "options"=>array(
               "label"=>"Parmanent disablement",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control",
               "id"=>"permanentDisablement"
           ),
       ));
       
       
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
    
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

