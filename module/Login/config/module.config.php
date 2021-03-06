<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Login;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Authentication\AuthenticationService;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'index',
                    ],
                    'constraints'=>[
                        'action' => '[a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ]
                ],
            ],

            'register' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/register',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'register',
                    ],
                ],
            ],

            'resetpassword' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/reset-password',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'resetPassword',
                    ],
                ],
            ],

            'login' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'test' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/test',
                    'defaults' => [
                        'controller' => Controller\TestController::class,
                        'action'     => 'test',
                    ],
                ],
            ],      
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\UserController::class => Controller\Factory\UserControllerFactory::class,
            Controller\AuthController::class => Controller\Factory\AuthControllerFactory::class,
            Controller\TestController::class => Factory\ListControllerFactory::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            __NAMESPACE__.'_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register __NAMESPACE__.'_driver' for any entity under namespace `Users\Entity`
                    __NAMESPACE__.'\Entity' => __NAMESPACE__.'_driver',
                ],
            ],
        ],
    ],

    'service_manager'=>[
        'factories' => [
            Service\UserManager::class =>  Service\Factory\UserManagerFactory::class,
            Service\AuthManager::class =>  Service\Factory\AuthManagerFactory::class,
            Service\AuthAdapter::class =>  Service\Factory\AuthAdapterFactory::class,
            AuthenticationService::class=> Service\Factory\AuthenticationServiceFactory::class
        ]
    ],

    'access_filter'=>[
        'controllers'=>[
            Controller\UserController::class=>[
                //liệt kê các action cho phép khi chưa đăng nhập
                [
                    'actions' => ['setPassword', 'register'],
                    'allow' => "all"
                ],
                //liệt kê các action yêu cầu phải đăng nhập
                [
                    'actions' => ['index'],
                    'allow' => "limit"
                ]
            ],

            Controller\TestController::class=>[
                //liệt kê các action cho phép khi chưa đăng nhập
                [
                    'actions' => ['testt'],
                    'allow' => "all"
                ],
                //liệt kê các action yêu cầu phải đăng nhập
                [
                    'actions' => ['test'],
                    'allow' => "limit"
                ]
            ]
        ],
    ]
];
