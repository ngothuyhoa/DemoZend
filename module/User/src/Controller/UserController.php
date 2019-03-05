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

    public function loginAction()
    {
        if($this->getRequest()->isPost()){
            $a = $this->getRequest();
            var_dump($a);
        }
        
        $view = new ViewModel(); 
        $view->getTemplate('login');
        return $view; 
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
    			return $this->redirect()->toRoute('login'); 
    		} else {
    			echo "Insert Fail";
    		}
    	}
    	$form = new UserForm;	
    	$view = new ViewModel(['form' => $form]); 
      	$view->getTemplate('user/add');
      	return $view; 
    }

    public function editAction()
    {
        $params = [
            'id' => $this->params('id'),
        ];
        
        if($this->getRequest()->isPost()){
            $data = [
                'user_name' => $this->getRequest()->getPost('user_name'),
                'email' => $this->getRequest()->getPost('email'),
                'id' => $this->params('id'),
            ];

            $prepare = $this->adapter->query("UPDATE users SET user_name = ?, email = ? WHERE id = ?", Adapter::QUERY_MODE_PREPARE);
            $update = $prepare->execute($data);
            if($update->getAffectedRows() > 0){
                return $this->redirect()->toRoute('user'); 
            } else {
                echo "Insert Fail";
            }
        }
        $prepare = $this->adapter->query("SELECT * FROM users WHERE id = ?", Adapter::QUERY_MODE_PREPARE);
        $result = $prepare->execute($params);
        $result = $result->current();

        $form = new UserForm;   
        $view = new ViewModel(['form' => $form, 'row' => $result]); 
        $view->getTemplate('user/add');
        
        return $view; 
    }

    public function deleteAction() {
        $params = [
            'id' => $this->params('id'),
        ];
        $prepare = $this->adapter->query("DELETE FROM users WHERE id = ?", Adapter::QUERY_MODE_PREPARE);
        $delete = $prepare->execute($params);

        if($delete->getAffectedRows() > 0){
            return $this->redirect()->toRoute('user');   
        } else {
            echo "Fail";
        }
        exit;

    }
}
