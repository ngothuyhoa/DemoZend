<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use User\Form\UserForm;

class UserController extends AbstractActionController
{
	private $adapter;
	public function __construct() {
		$config = [
			'driver' => 'mysqli',
			'database' => 'tutorials',
			'username' => 'admin',
			'password' => 'ngothuyhoa'
		];
		$this->adapter = new Adapter($config);
	}
	
    public function indexAction()
    {
    	$users = $this->adapter->query("SELECT * FROM users", Adapter::QUERY_MODE_EXECUTE);
	   	$view = new ViewModel(['users' => $users]); 
      	$view->getTemplate('user/index');
      	return $view; 
    }

    public function addAction()
    {
    	if($this->getRequest()->isPost()){
    		$params = [
    			'user_name' => $this->getRequest()->getPost('user_name'),
    			'email' => $this->getRequest()->getPost('email'),
    			'password' => $this->getRequest()->getPost('password'),
    		];

    		$prepare = $this->adapter->query("INSERT INTO users(user_name, email, password) VALUE (?, ?, ?)");
    		$insert = $prepare->execute($params);
    		if($insert->getAffectedRows() > 0){
    			return $this->redirect()->toRoute('user'); 
    		} else {
    			echo "Insert Fail";
    		}
    	}
    	$form = new UserForm;	
    	$view = new ViewModel(['form' => $form]); 
      	$view->getTemplate('user/add');
      	return $view; 
    }
}
