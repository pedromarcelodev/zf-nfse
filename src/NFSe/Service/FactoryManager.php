<?php

namespace NFSe\Service;

use \Zend\ServiceManager\ServiceManager;

/**
 * Description of NFSeFactoryManager
 *
 * @author Pedro Marcelo
 */
class FactoryManager implements NFSeLocatorInterface
{
    /**
     * Factories mapped in module.config.php file
     *
     * @var array
     */
    private $factories = [];
    
    /**
     * 
     * @var ServiceManager
     */
    private $serviceManager;
    
    public function __construct(ServiceManager $serviceManager)
    {
        $config = $serviceManager->get('Config');
        
        if (!isset($config['nfse']['xml']['map']['factories']) ||
            (is_array($config['nfse']['xml']['map']['factories']) && empty($config['nfse']['xml']['map']['factories'])))
        {
            throw new \Exception("There are no factories mapped");
        }
        $this->factories = $config['nfse']['xml']['map']['factories'];
        $this->serviceManager = $serviceManager;
    }
    
    /**
     * Returns a mapped factory. If this factory not exists, then an exception is thrown
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
        $factory = $this->factories[$name];
        $result = null;
        
        if (is_string($factory))
        {
            $factory = preg_replace("/^([\w])/", "\$1", $factory);
            
            if (class_exists($factory))
            {
                $result = new $factory($this);
            }
        }
        else if (is_callable($factory))
        {
            $result = call_user_func($factory, $this);
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
        return isset($this->factories[$name]);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
}
