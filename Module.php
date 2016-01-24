<?php

namespace NFSe;

/**
 * Module Bootstrap
 *
 * @package NFSe
 */
class Module
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'NFSe\Service\FactoryManager' => function($serviceManager) {
                    return new Service\FactoryManager($serviceManager);
                },
                'NFSe\Service\EntityManager' => function($serviceManager) {
                    return new Service\EntityManager($serviceManager);
                },
                'NFSe\Service\FormatterManager' => function($serviceManager) {
                    return new Service\FormatterManager($serviceManager);
                },
            ),
        );
    }
}