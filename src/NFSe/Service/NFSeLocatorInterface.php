<?php

namespace NFSe\Service;

use \Zend\ServiceManager\ServiceLocatorInterface;
use \Zend\ServiceManager\ServiceManager;

/**
 *
 * @author Pedro Marcelo
 */
interface NFSeLocatorInterface extends ServiceLocatorInterface
{
    public function __construct(ServiceManager $serviceManager);
    
    /**
     * 
     * @return ServiceManager
     */
    public function getServiceManager();
}
