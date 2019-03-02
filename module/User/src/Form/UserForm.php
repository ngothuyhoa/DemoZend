<?php  
namespace User\Form; 
use Zend\Form\Form;  

class UserForm extends Form { 
    public function __construct() { 

      // we want to ignore the name passed 
        parent::__construct();  
        $this->add([ 
           'name' => 'user_name', 
           'type' => 'Text',
           'attributes' => [
           		'class' => 'form-control',
           ],
           'options' => [ 
            'label' => 'Name', 
            ] 
        ]); 
        $this->add([ 
           'name' => 'email', 
           'type' => 'email',
           'attributes' => [
           		'class' => 'form-control',
           ],
           'options' => [ 
            'label' => 'Email', 
            ] 
        ]); 
        $this->add([ 
           'name' => 'password', 
           'type' => 'password',
           'attributes' => [
           		'class' => 'form-control',
           ],
           'options' => [ 
            'label' => 'Password', 
            ] 
        ]);
        $this->add([ 
           'name' => 'send', 
           'type' => 'Submit',
           'attributes' => [
           		'value' => 'Send Email',
          		'class' => 'btn btn-primary',
           	],
        ]); 
    } 
}   