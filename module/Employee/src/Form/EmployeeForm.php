<?php  
namespace Employee\Form; 
use Zend\Form\Form;  

class EmployeeForm extends Form { 
    public function __construct($name = null) { 

      // we want to ignore the name passed 
        parent::__construct('employee');  
        $this->add([ 
           'name' => 'id', 
           'type' => 'Hidden', 
        ]); 
        $this->add([ 
           'name' => 'emp_name', 
           'type' => 'Text', 
           'options' => [ 
            'label' => 'Name', 
            ] 
        ]); 
        $this->add([ 
           'name' => 'emp_job', 
           'type' => 'Text', 
           'options' => [ 
            'label' => 'Job', 
            ] 
        ]); 
        $this->add([ 
            'name' => 'submit', 
            'type' => 'Submit', 
            'attributes' => [
            'value' => 'Go', 
            'id' => 'submitbutton', 
            ] 
        ]); 
    } 
}   