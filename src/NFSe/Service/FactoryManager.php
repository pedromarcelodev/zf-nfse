<?php

namespace NFSe\Service;

use \Zend\ServiceManager\ServiceLocatorInterface;

/**
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
     * @var ServiceLocatorInterface
     */
    private $serviceManager;
    
    /**
     * An array containing instances of FactoryInterface
     *
     * @var array
     */
    private $instances = [];
    
    public function __construct(ServiceLocatorInterface $serviceManager)
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
     * @throws \NFSe\XML\InexistentXMLTagException
     */
    public function get($name)
    {
        if (!$this->has($name))
        {
            throw new \NFSe\XML\InexistentXMLTagException("The '$name' tag is not mapped");
        }
        $factory = $this->factories[$name];
        $instance = null;
        
        if (is_string($factory))
        {
            $instance = $this->getFromString($factory);
        }
        else if (is_callable($factory))
        {
            $instance = call_user_func($factory, $this);
        }
        
        if (!($instance instanceof \NFSe\XML\Factory\FactoryInterface))
        {
            throw new \NFSe\XML\Factory\FactoryNotFoundException("The factory for '$name' could not be found");
        }
        $className = get_class($instance);
        
        if (!isset($this->instances[$className]))
        {
            $this->instances[$className] = $instance;
        }
        return $instance;
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
    public function getServiceLocator()
    {
        return $this->serviceManager;
    }
    
    /**
     * 
     * @param string $factory
     * @return \NFSe\Formatter\FormatterInterface|null
     */
    private function getFromString($factory)
    {
        $instance = null;
        $factory = preg_replace("/^([\w])/", "\$1", $factory);
        
        if (class_exists($factory))
        {
            if (isset($this->instances[$factory]))
            {
                $instance = $this->instances[$factory];
            }
            else
            {
                $instance = new $factory($this);
            }
        }
        return $instance;
    }
}
