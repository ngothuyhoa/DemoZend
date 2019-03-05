<?php
namespace Login\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\EmailAddress;
use Zend\Validator\Identical;
use Zend\Validator\Regex;
use Zend\Validator\Date;

class UserForm extends Form{

    private $action;
    public function __construct($action = "add" ){
        parent::__construct();
        $this->setAttributes([
            'name'=>'user-form',
            'class'=>'form-horizontal'
        ]);
        $this->action = $action;
        $this->addElements();
        $this->validator();
    }
    private function addElements(){
        //username
        $this->add([
            'type'=>'text',
            'name'=>'username',
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'Nhập username',
                'id'=>'username'
            ],
            'options'=>[
                'label'=>'Username:',
                'label_attributes'=>[
                    'for' => 'username',
                    'class'=>'col-md-3 control-label'
                ]
            ]
        ]);
        
        if($this->action=="add"){
            //password
            $this->add([
                'type'=>'password',
                'name'=>'password',
                'attributes'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Nhập mật khẩu',
                    'id'=>'password'
                ],
                'options'=>[
                    'label'=>'Mật khẩu:',
                    'label_attributes'=>[
                        'for' => 'password',
                        'class'=>'col-md-3 control-label'
                    ]
                ]
            ]);

            //confirm_password
            $this->add([
                'type'=>'password',
                'name'=>'confirm_password',
                'attributes'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Nhập lại mật khẩu',
                    'id'=>'confirm_password'
                ],
                'options'=>[
                    'label'=>'Nhập lại mật khẩu:',
                    'label_attributes'=>[
                        'for' => 'confirm_password',
                        'class'=>'col-md-3 control-label'
                    ]
                ]
            ]);
        }
        
        //email
        $this->add([
            'type'=>'email',
            'name'=>'email',
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'Nhập email',
                'id'=>'email'
            ],
            'options'=>[
                'label'=>'Email:',
                'label_attributes'=>[
                    'for' => 'email',
                    'class'=>'col-md-3 control-label'
                ]
            ]
        ]);

        //btn
        $this->add([
            'type'=>'submit',
            'name'=>'btnSubmit',
            'attributes'=>[
                'class'=>'btn btn-success',
                'value'=>'Save'
            ]
        ]);
    }

    private function validator(){
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'=>'username',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StringToLower'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
                [
                    'name'=>'NotEmpty',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'messages'=>[
                            NotEmpty::IS_EMPTY=>'Username không được rỗng'
                        ]
                    ]
                ],
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'min'=>8,
                        'max'=>50,
                        'messages'=>[
                            StringLength::TOO_SHORT=>'Username ít nhất %min% kí tự',
                            StringLength::TOO_LONG=>'Username không quá %max% kí tự'
                        ]
                    ]
                ]
            ]
        ]);
        if($this->action=="add"){
            $inputFilter->add([
                'name'=>'password',
                'required'=>true,
                'filters'=>[
                    ['name'=>'StringTrim'],
                    ['name'=>'StripTags'],
                    ['name'=>'StripNewlines']
                ],
                'validators'=>[
                    [
                        'name'=>'NotEmpty',
                        'options'=>[
                            'break_chain_on_failure'=>true,
                            'messages'=>[
                                NotEmpty::IS_EMPTY=>'Mật khẩu không được rỗng'
                            ]
                        ]
                    ],
                    [
                        'name'=>'StringLength',
                        'options'=>[
                            'break_chain_on_failure'=>true,
                            'min'=>8,
                            'max'=>20,
                            'messages'=>[
                                StringLength::TOO_SHORT=>'Mật khẩu ít nhất %min% kí tự',
                                StringLength::TOO_LONG=>'Mật khẩu không quá %max% kí tự',
                            ]
                        ]
                    ],
                ]
            ]);
            $inputFilter->add([
                'name'=>'confirm_password',
                'required'=>true,
                'filters'=>[
                    ['name'=>'StringTrim'],
                    ['name'=>'StripTags'],
                    ['name'=>'StripNewlines']
                ],
                'validators'=>[
                    [
                        'name'=>'NotEmpty',
                        'options'=>[
                            'break_chain_on_failure'=>true,
                            'messages'=>[
                                NotEmpty::IS_EMPTY=>'Mật khẩu nhập lại không được rỗng'
                            ]
                        ]
                    ],
                    [
                        'name'=>'Identical',
                        'options'=>[
                            'break_chain_on_failure'=>true,
                            'token'=>'password',
                            'messages'=>[
                                Identical::NOT_SAME=>'Mật khẩu không giống nhau',
                                Identical::MISSING_TOKEN=>'Missing token'
                            ]
                        ]
                    ],
                ]
            ]);
        }

        $inputFilter->add([
            'name'=>'email',
            'required'=>true,
            'filters'=>[
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines']
            ],
            'validators'=>[
                [
                    'name'=>'Regex',
                    'break_chain_on_failure'=>true,
                    'options'=>[
                        'pattern'=>"/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",
                        'messages'=>[
                            Regex::NOT_MATCH=>'Email phải chứa các kí tự %pattern%'
                        ]
                    ]
                ],
                [
                    'name'=>'NotEmpty',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'messages'=>[
                            NotEmpty::IS_EMPTY=>'Email không được rỗng'
                        ]
                    ]
                ],
                [
                    'name'=>'StringLength',
                    'options'=>[
                        'break_chain_on_failure'=>true,
                        'min'=>10,
                        'max'=>50,
                        'messages'=>[
                            StringLength::TOO_SHORT=>'Email ít nhất %min% kí tự',
                            StringLength::TOO_LONG=>'Email không quá %max% kí tự',
                        ]
                    ]
                ],
                [
                    'name'=>'EmailAddress',
                    'break_chain_on_failure'=>true,
                    'options'=>[
                        'messages'=>[
                            \Zend\Validator\EmailAddress::INVALID_FORMAT=>'Email không đúng định dạng',
                            \Zend\Validator\EmailAddress::INVALID_HOSTNAME=>'Hostname không đúng'
                        ]
                    ]
                ],
                
            ]
        ]);

    }
}

?>