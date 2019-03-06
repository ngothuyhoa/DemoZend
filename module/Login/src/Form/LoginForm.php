<?php
namespace Login\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

class LoginForm extends Form{
    public function __construct(){
        parent::__construct();
        
        $this->loginForm(); //định nghĩa form
        $this->loginInputFilter(); //định nghĩa cho filter+validate
    }

    //create textfield
    private function loginForm(){
        //username
        $username = new Element\Text('username');
        $username->setLabel('Username: ')
            ->setLabelAttributes([
                'for' => 'username',
                'class' => 'col-sm-3 control-label'
            ]);
        $username->setAttributes([
            'id'=>'username',
            'class'=>'form-control',
            'placeholder' => 'Enter username'
        ]);
        $this->add($username);

        //password
        $pw = new Element\Password('password');
        $pw->setLabel('Password:')
            ->setLabelAttributes([
                'for' =>'password',
                'class'=>'col-sm-3 control-label'
            ]);
        $pw->setAttributes([
            'id'=>'password',
            'class'=>'form-control',
            'placeholder'=>'Enter your pass'
        ]);
        $this->add($pw);

        //remember
        $remember_me = new Element\Checkbox('remember');
        $remember_me->setLabel('Remember me: ')
                    ->setLabelAttributes([
                        'for'=>'remember'
                    ]);
        $remember_me->setAttributes([
            'id'=>'remember',
            'value'=>1,
            'required'=>false
        ]);
        $this->add($remember_me);

        //submit
        $submit = new Element\Submit('submit');
        $submit->setAttributes([
            'value'=>'Login',
            'class'=>'btn btn-success'
        ]);
        $this->add($submit);


    }

    //create inputfilter
    private function loginInputFilter(){
        $inputFilter = new InputFilter\InputFilter();
        $this->setInputFilter($inputFilter);

        //username
        $inputFilter->add([
            'name'=>'username',
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
                            \Zend\Validator\StringLength::TOO_SHORT=>'Username ít nhất %min% kí tự',
                            \Zend\Validator\StringLength::TOO_LONG=>'Username không quá %max% kí tự'
                        ]
                    ]
                ]
            ]
        ]);

        //pw
        $inputFilter->add([
            'name'=>'password',
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
                        'max'=>20,
                        'messages'=>[
                            \Zend\Validator\StringLength::TOO_SHORT=>'Mật khẩu ít nhất %min% kí tự',
                            \Zend\Validator\StringLength::TOO_LONG=>'Mật khẩu không quá %max% kí tự'
                        ]
                    ]
                ],
            ]
        ]);

        //remember me
        $inputFilter->add([
            'name'=>'remember',
            'required'=>false,
            'validators'=>[
                [
                    'name'=>'InArray',
                    'options'=>[
                        'haystack'=>[0,1],
                        'messages'=>[
                            \Zend\Validator\InArray::NOT_IN_ARRAY=>'Dữ liệu không hợp lệ',
                           ]
                    ]
                ]
            ]
        ]);

    }
}
?>