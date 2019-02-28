<?php  
namespace Employee\Controller; 
use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel;
use Employee\Model\Employee; 
use Employee\Model\EmployeeTable;  

class EmployeeController extends AbstractActionController { 
   /*private $table;  
   public function __construct(EmployeeTable $table) { 
      $this->table = $table; 
   } */ 
   public function indexAction() { 
      $a = 10;
      $view = new ViewModel(['a' => $a]); 
      $view->getTemplate('employee/employee/index');
      return $view;
   } 

   public function detailAction() {
   		$a = 10;
      	$view = new ViewModel(['a' => $a]); 
      	$view->getTemplate('employee/employee/detail');
      	return $view; 
   } 
} 