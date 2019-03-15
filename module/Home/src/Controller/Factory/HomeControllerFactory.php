<?php
namespace Home\Controller\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceManager;
use Home\Service\BookManager;
use Home\Controller\HomeController;


class HomeControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $bookManager = $container->get(BookManager::class);
        
        return new HomeController($entityManager, $bookManager);
    }
}


?>