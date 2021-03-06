<?php  
namespace Employee\Controller; 
use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel;
use Employee\Model\Employee; 
use Employee\Model\EmployeeTable;
use Employee\Form\EmployeeForm;

class EmployeeController extends AbstractActionController { 
    private $table;  
    public function __construct(EmployeeTable $table) { 
        $this->table = $table; 
    }  
    public function indexAction() {
        $view = new ViewModel([ 
            'data' => $this->table->fetchAll(), 
        ]);
       //echo $this->table->fetchAll();
        return $view;
    } 

    public function detailAction() {
   		$a = 10;
      	$view = new ViewModel(['a' => $a]); 
      	$view->getTemplate('employee/employee/detail');
      	return $view; 
    }

    public function addAction() { 
        $form = new EmployeeForm();  
        $form->get('submit')->setValue('Add');  
        $request = $this->getRequest(); 
          
        if ($request->isPost()) { 
            $employee = new Employee(); 
            $form->setInputFilter($employee->getInputFilter()); 
            $form->setData($request->getPost());  
             
            if ($form->isValid()) { 
                $employee->exchangeArray($form->getData()); 
                $this->table->saveEmployee($employee);                 
                // Redirect to list of employees 
                return $this->redirect()->toRoute('employee'); 
            } 
        } 
        $view = new ViewModel(['form' => $form]);
        $view->getTemplate('employee/employee/add');
        return $view;
    }

    public function editAction() { 
        $id = (int) $this->params()->fromRoute('id', 0); 
        if (!$id) { 
            return $this->redirect()->toRoute('employee',[ 
                'action' => 'add' 
            ]); 
        }  
        try { 
            $employee = $this->table->getEmployee($id); 
        } catch (\Exception $ex) { 
            return $this->redirect()->toRoute('employee', [
                'action' => 'index' 
            ]); 
       }      
        $form = new EmployeeForm(); 
        $form->bind($employee); 
        $form->get('submit')->setAttribute('value', 'Edit');  
        $request = $this->getRequest(); 
       
        if ($request->isPost()) { 
            $form->setInputFilter($employee->getInputFilter()); 
            $form->setData($request->getPost());  
            if ($form->isValid()) { 
                $this->table->saveEmployee($employee);  
             // Redirect to list of employees 
                return $this->redirect()->toRoute('employee'); 
            } 
        }  
        $view = new ViewModel(['id' => $id, 'form' => $form]); 
        $view->getTemplate('employee/employee/add');

        return $view;  
    }
} 