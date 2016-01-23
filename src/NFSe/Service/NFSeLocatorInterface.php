<?php

namespace NFSe\Service;

use \Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author Pedro Marcelo
 */
interface NFSeLocatorInterface extends ServiceLocatorInterface
{
    public function __construct(ServiceLocatorInterface $serviceManager);
    
    /**
     * 
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator();
}
