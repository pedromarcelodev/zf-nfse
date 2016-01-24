<?php

namespace NFSe\Service;

use \Zend\ServiceManager\ServiceLocatorInterface;

/**
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
     * @var ServiceLocatorInterface
     */
    private $serviceManager;
    
    /**
     *
     * @var FormatterManager
     */
    private $formatterManager;
    
    public function __construct(ServiceLocatorInterface $serviceManager)
    {
        $config = $serviceManager->get('Config');
        
        if (!isset($config['nfse']['xml']['map']['entities']) ||
            (is_array($config['nfse']['xml']['map']['entities']) && empty($config['nfse']['xml']['map']['entities'])))
        {
            throw new \Exception("There are no entities mapped");
        }
        $this->entities = $config['nfse']['xml']['map']['entities'];
        $this->serviceManager = $serviceManager;
        $this->formatterManager = $serviceManager->get('NFSe\Service\FormatterManager');
    }

    /**
     * Returns a mapped entity. If this entity not exists, then an exception is thrown
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
        $entity = $this->entities[$name];
        $result = null;
        $type = $this->getValidType($entity);
        
        if (!empty($type))
        {
            $result = call_user_func([$this, "getFrom$type"], $entity);
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
    public function getServiceLocator()
    {
        return $this->serviceManager;
    }
    
    /**
     * 
     * @return FormatterManager
     */
    public function getFormatterManager()
    {
        return $this->formatterManager;
    }
    
    /**
     * Returns the variable type between valid types.
     * 
     * @param mixed $entity
     * @return string
     */
    private function getValidType($entity)
    {
        if (is_string($entity))
        {
            return 'String';
        }
        else if (is_callable($entity))
        {
            return 'Callable';
        }
        else if (is_array($entity))
        {
            return 'Array';
        }
        return '';
    }
    
    /**
     * Returns an entity using a string
     * 
     * @param string $entity
     * @return mixed
     */
    private function getFromString($entity)
    {
        if ($this->getServiceLocator()->has($entity))
        {
            return $this->getServiceLocator()->get($entity);
        }
        
        $result = null;
        $entity = preg_replace("/^([\w])/", "\\$1", $entity);
            
        if (class_exists($entity))
        {
            $reflection = new \ReflectionClass($entity);

            if ($reflection->implementsInterface("\NFSe\XML\Entity\CompoundEntityInterface"))
            {
                $result = new $entity();
            }
        }
    }
    
    /**
     * Returns an entity using an array
     * 
     * @param array $entity
     * @return \NFSe\XML\Entity\SimpleEntityInterface|null
     */
    private function getFromArray($entity)
    {
        $result = null;
        
        if (isset($entity["class"]) && class_exists($entity["class"]))
        {
            $entityClass = $entity["class"];
            $reflection = new \ReflectionClass($entityClass);
            
            if ($reflection->implementsInterface("\NFSe\XML\Entity\SimpleEntityInterface") &&
                isset($entity["formatter"]))
            {
                $formatter = null;
                
                if ($this->getServiceLocator()->has($entity["formatter"]))
                {
                    $formatter = $this->getServiceLocator()->get($entity["formatter"]);
                }
                else if ($this->getFormatterManager()->has($entity["formatter"]))
                {
                    $formatter = $this->getFormatterManager()->get($entity["formatter"]);
                }
                
                if (!is_null($formatter))
                {
                    $result = new $entityClass($formatter);
                }
            }
        }
        
        return $result;
    }
    
    /**
     * Returns an entity using a callable
     * 
     * @param callable $entity
     * @return mixed
     */
    private function getFromCallable($entity)
    {
        return call_user_func($entity, $this);
    }
}
