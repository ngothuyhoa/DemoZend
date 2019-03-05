<?php

namespace Login;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig(){
        return [
            'Zend\Loader\StandardAutoloader'=>[
                'namespace'=>[
                    __NAMESPACE__=> __DIR__.'/src/'.__NAMESPACE__
                ]
            ]
        ];
    }
}
