<?php
namespace Blog\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

class PostForm extends Form
{
    public function __construct(){
        parent::__construct();
        
        $this->init(); //định nghĩa form
        $this->InputFilter(); //định nghĩa cho filter+validate
    }

    public function init()
    {
       /* $this->add([
        'name' => 'post',
        'type' => PostFieldset::class,
        'options' => [
            'use_as_base_fieldset' => true,
        ],
        
    ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Insert new Post',
                'class' => 'btn btn-danger'
            ],
        ]);*/

        //title
        $title = new Element\Text('title');
        $title->setLabel('Title ')
            ->setLabelAttributes([
                'for' => 'title',
                'class' => 'col-sm-3 control-label'
            ]);
        $title->setAttributes([
            'id'=>'title',
            'class'=>'form-control',
            'placeholder' => 'Enter title'
        ]);
        $this->add($title);

        //text
        $text = new Element\Text('text');
        $text->setLabel('Text ')
            ->setLabelAttributes([
                'for' => 'text',
                'class' => 'col-sm-3 control-label'
            ]);
        $text->setAttributes([
            'id'=>'text',
            'class'=>'form-control',
            'placeholder' => 'Enter text'
        ]);
        $this->add($text);

        $submit = new Element\Submit('submit');
        $submit->setAttributes([
            'value'=>'Add',
            'class'=>'btn btn-success'
        ]);
        $this->add($submit);
    }

    private function InputFilter(){
        $inputFilter = new InputFilter\InputFilter();
        $this->setInputFilter($inputFilter);

        //username
        $inputFilter->add([
            'name'=>'title',
            'required'=>true,
            'filters'=>[
                //trim/newline/tolower/toupper
                ['name'=>'StringToLower'],
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'min'=>6,
                        'max'=>50,
                        'messages'=>[
                            \Zend\Validator\StringLength::TOO_SHORT=>'Title ít nhất %min% kí tự',
                            \Zend\Validator\StringLength::TOO_LONG=>'Title không quá %max% kí tự'
                        ]
                    ]
                ]
            ]
        ]);

        $inputFilter->add([
            'name'=>'text',
            'required'=>true,
            'filters'=>[
                //trim/newline/tolower/toupper
                ['name'=>'StringToLower'],
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'min'=>6,
                        'max'=>50,
                        'messages'=>[
                            \Zend\Validator\StringLength::TOO_SHORT=>'Content ít nhất %min% kí tự',
                            \Zend\Validator\StringLength::TOO_LONG=>'Content không quá %max% kí tự'
                        ]
                    ]
                ]
            ]
        ]);
    }

}