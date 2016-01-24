<?php

namespace NFSe\Service;

use \Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author Pedro Marcelo
 */
class FormatterManager implements NFSeLocatorInterface
{
    /**
     *
     * @var ServiceLocatorInterface
     */
    private $serviceLocator;
    
    /**
     * Formatters mapped in module.config.php file
     *
     * @var array
     */
    private $formatters = [];
    
    public function __construct(ServiceLocatorInterface $serviceManager)
    {
        $config = $serviceManager->get('Config');
        
        if (!isset($config['nfse']['xml']['map']['formatters']) ||
            (is_array($config['nfse']['xml']['map']['formatters']) && empty($config['nfse']['xml']['map']['formatters'])))
        {
            throw new \Exception("There are no formatters mapped");
        }
        $this->formatters = $config['nfse']['xml']['map']['formatters'];
        $this->serviceLocator = $serviceManager;
    }

    /**
     * Returns an instance of FormatterInterface
     * 
     * @param string $name
     * @return mixed
     * @throws \NFSe\Formatter\FormatterNotFoundException
     */
    public function get($name)
    {
        if (!$this->has($name))
        {
            throw new \NFSe\Formatter\FormatterNotFoundException("'$name' formatter could not be found");
        }
        
        $formatter = $this->formatters[$name];
        
        if (is_string($formatter))
        {
            if ($this->getServiceLocator()->has($formatter))
            {
                return $this->getServiceLocator()->get($formatter);
            }
            else
            {
                return new $formatter();
            }
        }
        else if (is_callable($formatter))
        {
            return call_user_func($formatter, $this);
        }
    }

    /**
     * 
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * This function check if the formatter has been mapped in module.config.php file
     * 
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->formatters[$name]);
    }

}
