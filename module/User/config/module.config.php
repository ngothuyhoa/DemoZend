<?php  
namespace User;
use Zend\ServiceManager\Factory\InvokableFactory; 
use Zend\Router\Http\Segment; 
use Zend\Router\Http\Literal;
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;

return [ 
    'controllers' => [ 
        'factories' => [ 
         	Controller\UserController::class => InvokableFactory::class,
        ], 
    ], 
    'router' => [ 
        'routes' => [ 
            'user' => [ 
                'type' => Literal::class,
                'options' => [ 
                    'route' => '/user',
                    'defaults' => [ 
                        'controller' => Controller\UserController::class,
                        'action' => 'index', 
                    ], 
                ],
            ], 

            'add' => [ 
                'type' => Literal::class,
                'options' => [ 
                    'route' => '/user/add',
                    'defaults' => [ 
                        'controller' => Controller\UserController::class,
                        'action' => 'add', 
                    ], 
                ], 
            ],
        ], 
    ],

   'view_manager' => [

    'template_map' => [
            'user/index' => __DIR__ . '/../view/user/user/index.phtml',
            'user/add' => __DIR__ . '/../view/user/user/add.phtml',
        ],
        'template_path_stack' => [ 
            __DIR__ . '/../view', 
        ], 
    ], 
]; 