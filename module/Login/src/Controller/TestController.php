<?php
namespace Login\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Login\Entity\Users;
use Login\Form\UserForm;

class TestController extends AbstractActionController{

    public function testAction(){
    	echo " Xin chao moi nguoi";
    	return false;
    }
}