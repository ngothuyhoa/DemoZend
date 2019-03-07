<?php
namespace Login\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Login\Entity\Users;
use Login\Form\UserForm;

class UserController extends AbstractActionController{

    private $entityManager;
    private $userManager;

    public function __construct($entityManager, $userManager){
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
    }

    public function indexAction(){
        $users = $this->entityManager->getRepository(Users::class)->findAll();
        //$users = $this->entityManager->getRepository(Users::class)->findBy([]);
        /*foreach ($users as $user) {
        	echo '<pre>';
        	var_dump($user->getUserName());
        	echo '</pre>';
        }*/
        $view = new ViewModel(['users' => $users]);
        $view->setTemplate('users/index');
        
        return $view;
    }

    public function registerAction(){
        $form = new UserForm('add');
        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                $user = $this->userManager->addUser($data);
                
                return $this->redirect()->toRoute('user');
            }
        }
        $view = new ViewModel(['form'=>$form]);
        $view->setTemplate('users/register');
        return $view;
    }

    public function resetPasswordAction() {
        echo 'hhi';
        return false;
    }
}