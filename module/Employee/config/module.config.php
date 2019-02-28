<?php  
namespace Employee;
use Zend\ServiceManager\Factory\InvokableFactory; 
use Zend\Router\Http\Segment;  
return [ 
   'controllers' => [ 
      'factories' => [ 
         	Controller\EmployeeController::class => InvokableFactory::class,

      ], 
   ], 
   'router' => [ 
      'routes' => [ 
         'employee' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/employee[/:action[/:id]]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                  'id' => '[0-9]+', 
               ], 
               'defaults' => [ 
                  'controller' => Controller\EmployeeController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'employeeDetail' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/employee/detail[/:action[/:id]]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                  'id' => '[0-9]+', 
               ], 
               'defaults' => [ 
                  'controller' => Controller\EmployeeController::class,
                  'action' => 'detail', 
               ], 
            ], 
         ], 
      ], 
   ], 
   'view_manager' => [
      'template_map' => [
            'employee/employee/index' => __DIR__ . '/../view/employee/employee/index.phtml',
            'employee/employee/detail' => __DIR__ . '/../view/employee/employee/detail.phtml',
        ],

      'template_path_stack' => [ 
         'employee' => __DIR__ . '/../view', 
      ], 
   ], 
]; 