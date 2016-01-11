<?php

namespace NFSe\Service;

use \Zend\ServiceManager\ServiceManager;

/**
 * Description of NFSeEntityManager
 *
 * @author Pedro Marcelo
 */
class EntityManager implements NFSeLocatorInterface
{
    /**
     * Entities mapped in module.config.php file
     *
     * @var array
     */
    private $entities = [];
    
    /**
     *
     * @var ServiceManager
     */
    private $serviceManager;
    
    public function __construct(ServiceManager $serviceManager)
    {
        $config = $serviceManager->get('Config');
        
        if (!isset($config['nfse']['xml']['map']['entities']) ||
            (is_array($config['nfse']['xml']['map']['entities']) && empty($config['nfse']['xml']['map']['entities'])))
        {
            throw new \Exception("There are no entities mapped");
        }
        $this->entities = $config['nfse']['xml']['map']['entities'];
        $this->serviceManager = $serviceManager;
    }

    /**
     * Returns a mapped entity. If this entity not exists, then an exception is thrown
     * 
     * @param string $name
     * @return mixed
     * @throws \NFSe\Exception\InexistentXMLTagException
     */
    public function get($name)
    {
        if (!$this->has($name))
        {
            throw new \NFSe\Exception\InexistentXMLTagException("The '$name' tag is not mapped");
        }
        $entity = $this->entities[$name];
        $result = null;
        
        if (is_string($entity))
        {
            $entity = preg_replace("/^([\w])/", "\\$1", $entity);
            
            if (class_exists($entity))
            {
                $result = new $entity();
            }
        }
        else if (is_callable($entity))
        {
            $result = call_user_func($entity);
        }
        
        return $result;
    }
    
    /**
     * This function check if the tag has been mapped in module.config.php file
     * 
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->entities[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceManager()
    {
        
    }
}
