<?php
namespace Login\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Login\Entity\Users;
use Login\Form\LoginForm;
use Zend\Authentication\Result;

class AuthController extends AbstractActionController{

    private $entityManager, $userManager, $authManager, $authService;

    public function __construct($entityManager, $userManager,$authManager,$authService){
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
        $this->authManager = $authManager;
        $this->authService = $authService;
    }

    public function loginAction(){
        $form = new LoginForm;
        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                
                $result = $this->authManager->login($data['username'], $data['password'], $data['remember']);
                // print_r($result->getCode());
                // return false;
                if($result->getCode() == Result::SUCCESS){
                    return $this->redirect()->toRoute('admin');
                }
                else{
                   $message = current($result->getMessages());
                   $this->flashMessenger()->addErrorMessage($message);
                   return $this->redirect()->toRoute('login');
                }
            }

        }
        $view = new ViewModel(['form'=>$form]);
        $view->setTemplate('auth/login');
        return $view;
    }

    public function logoutAction(){
        $this->authManager->logout();
        return $this->redirect()->toRoute('login');
    }

}

?>