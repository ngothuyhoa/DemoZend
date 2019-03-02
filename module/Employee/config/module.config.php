<?php  
namespace Employee;
use Zend\ServiceManager\Factory\InvokableFactory; 
use Zend\Router\Http\Segment;  
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;

return [ 
    'controllers' => [ 
        'factories' => [ 
         	//Controller\EmployeeController::class => InvokableFactory::class,
            Controller\EmployeeController::class => function($container) {
                return new Controller\EmployeeController(
                   $container->get(Model\EmployeeTable::class)
                ); 
            },
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

            'add' => [ 
                'type' => Segment::class,
                'options' => [ 
                    'route' => '/employee/add[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+', 
                    ], 
                    'defaults' => [ 
                        'controller' => Controller\EmployeeController::class,
                        'action' => 'add', 
                    ], 
                ], 
            ],

            'employeeEdit' => [ 
                'type' => Segment::class,
                'options' => [ 
                    'route' => '/employee/edit',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+', 
                    ], 
                    'defaults' => [ 
                        'controller' => Controller\EmployeeController::class,
                        'action' => 'add', 
                    ], 
                ], 
            ],
        ], 
    ],

   'view_manager' => [
        'template_map' => [
            'employee/employee/index' => __DIR__ . '/../view/employee/employee/index.phtml',
            'employee/employee/detail' => __DIR__ . '/../view/employee/employee/detail.phtml',
            'employee/employee/login' => __DIR__ . '/../view/employee/employee/login.phtml',
            'employee/employee/add' => __DIR__ . '/../view/employee/employee/add.phtml',
            'employee/employee/edit' => __DIR__ . '/../view/employee/employee/edit.phtml',
        ],

        'template_path_stack' => [ 
            'employee' => __DIR__ . '/../view', 
        ], 
    ], 
]; 