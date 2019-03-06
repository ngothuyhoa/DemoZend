<?php
namespace Login\Controller\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceManager;
use Login\Service\UserManager;
use Login\Service\AuthManager;
use Login\Controller\AuthController;
use Zend\Authentication\AuthenticationService;

class AuthControllerFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $userManager = $container->get(UserManager::class);
        $authManager = $container->get(AuthManager::class);
        $authService = $container->get(AuthenticationService::class);
        
        return new AuthController($entityManager, $userManager,$authManager,$authService);
    }
}


?>