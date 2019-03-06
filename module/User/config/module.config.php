<?php  
namespace User;
use Zend\ServiceManager\Factory\InvokableFactory; 
use Zend\Router\Http\Segment; 
use Zend\Router\Http\Literal;
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;
use Zend\Authentication\AuthenticationService;

return [ 
    'controllers' => [ 
        'factories' => [ 
         	Controller\UserController::class => InvokableFactory::class,
            Controller\AuthController::class => Controller\Factory\AuthControllerFactory::class
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

            'edit' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/user/edit[/:id]',
                    'constraints' => [
                        'id' => '[0-9]+', 
                    ],
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'edit',
                    ],
                ],
            ],

            'delete' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/user/delete[/:id]',
                    'constraints' => [
                        'id' => '[0-9]+', 
                    ],
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'delete',
                    ],
                ],
            ],

            'login' => [ 
                'type' => Literal::class,
                'options' => [ 
                    'route' => '/loginn',
                    'defaults' => [ 
                        'controller' => Controller\UserController::class,
                        'action' => 'login', 
                    ], 
                ], 
            ],
        ], 
    ],

   'view_manager' => [

    'template_map' => [
            'user/index' => __DIR__ . '/../view/user/user/index.phtml',
            'user/add' => __DIR__ . '/../view/user/user/add.phtml',
            'login' => __DIR__ . '/../view/user/user/login.phtml',
        ],
        'template_path_stack' => [ 
            __DIR__ . '/../view', 
        ], 
    ],

    'service_manager'=>[
        'factories' => [
            Service\AuthManager::class => Service\Factory\AuthManagerFactory::class,
            Service\AuthAdapter::class => Service\Factory\AuthAdapterFactory::class,
            AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class

        ]
    ],
    
    'access_filter'=>[
        'controllers'=>[
            Controller\UserController::class=>[
                //liệt kê các action cho phép khi chưa đăng nhập
                [
                    'actions' => ['resetPassword','setPassword'],
                    'allow' => "all"
                ],
                //liệt kê các action yêu cầu phải đăng nhập
                [
                    'actions' => ['index','add','edit','delete','changePassword'],
                    'allow' => "limit"
                ]
            ]
        ]
    ]
]; 