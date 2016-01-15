<?php

namespace NFSe\Service;

use \DateTime;
use \Zend\ServiceManager\ServiceManager;

/**
 * Description of PatternManager
 *
 * @author Pedro Marcelo
 */
class PatternManager
{
    /**
     *
     * @var array
     */
    private $patterns = [];
    
    /**
     *
     * @var array
     */
    private $types = [];
    
    /**
     *
     * @var array
     */
    private $helpers = [];
    
    /**
     *
     * @var ServiceManager
     */
    private $serviceManager;
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this->helpers = $this->getDefaultHelpers();
        $config = $serviceManager->get("Config");
        
        if (isset($config['nfse']['pattern_manager']))
        {
            foreach ($config['nfse']['pattern_manager'] as $key => $value) {
                $this->addPatternItem($key, $value);
            }
        }
    }
    
    /**
     * Adds a new pattern item
     * 
     * @param string $key
     * @param array $options
     * @return boolean Returns true if item was added or false otherwise
     * @throws \Exception
     */
    public function addPatternItem($key, array $options)
    {
        if (!isset($this->patterns[$key]))
        {
            if (!isset($options['pattern']))
            {
                throw new \Exception("'$key' must have a pattern");
            }
            if (!isset($this->patterns[$key]))
            {
                $this->patterns[$key] = $options['pattern'];
            }
            if (!isset($options['type']))
            {
                $options['type'] = $key;

                if (!isset($this->types[$key]))
                {
                    $this->types[$key] = $options['type'];
                }
            }
            else
            {
                $this->types[$key] = $options['type'];
            }
            if (!isset($this->helpers[$options['type']]) && isset($options['helper']))
            {
                $this->helpers[$options['type']] = $options['helper'];
            }
            return true;
        }
        return false;
    }
    
    /**
     * Returns a transformed value according to the pattern
     * 
     * @param string $key
     * @param mixed $value
     * @return mixed
     * @throws \NFSeTest\Service\InexistentPatternValueException If the pattern does not exists
     */
    public function getValue($key, $value)
    {
        if (!isset($this->patterns[$key]))
        {
            throw new \NFSeTest\Service\InexistentPatternValueException("The '$key' was not added to the patterns");
        }
        $pattern = $this->patterns[$key];
        $type = $this->types[$key];
        
        if (isset($this->helpers[$type]))
        {
            $helper = $this->helpers[$type];
            
            while (is_string($helper) && isset($this->helpers[$helper])) {
                $helper = $this->helpers[$helper];
            }
            
            if (is_callable($helper))
            {
                return call_user_func($helper, $pattern, $value);
            }
        }
        
        return null;
    }
    
    /**
     * Returns an instance of ServiceManager
     * 
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
    
    /**
     * Returns an array that contains default helpers for transform values
     * 
     * @return array
     */
    private function getDefaultHelpers()
    {
        return array(
            "datetime" => function ($pattern, $value) {
                return DateTime::createFromFormat($pattern, $value);
            },
            "float" => function ($pattern, $value) {
                $integerPart = intval($value);
                $decimalPart = $value - $integerPart;
                $start = "";
                $end = "";
                
                if (strpos($pattern, "+9") === 0)
                {
                    $start = "$integerPart";
                }
                else if (preg_match("/^(\d+)/", $pattern, $matches))
                {
                    $max = strlen($matches[1]);
                    $strIntegerPart = "$integerPart";
                    $strlen = strlen($strIntegerPart);
                    $length = ($max < $strlen)? $max : $strlen;
                    $start = substr($strIntegerPart, $length * -1);
                }
                else
                {
                    $start = "0";
                }
                
                if ($decimalPart > 0 && preg_match("/\.(\d+)$/", $pattern, $matches))
                {
                    $end = ".";
                    $max = strlen($matches[1]);
                    $strDecimalPart = strtr("$decimalPart", array(
                        '0.' => '',
                        '0,' => '',
                    ));
                    $strlen = strlen($strDecimalPart);
                    $length = ($max < $strlen)? $max : $strlen;
                    $end .= substr($strDecimalPart, 0, $length);
                }
                return floatval($start . $end);
            },
            "mask" => function($pattern, $value) {
                $value = (string) $value;
                $length = strlen($value);
                
                if ($length > 0 && preg_match_all("/([#]+)/", $pattern, $matches))
                {
                    preg_match_all("/([^#]+)/", $pattern, $matches2);
                    $index = 0;
                    $numberOfHash = substr_count($pattern, "#");
                    $newValue = "";
                    $masks = $matches[0];
                    $separators = $matches2[0];
                    $separator = current($separators);
                    
                    if (strpos($pattern, "#") > 0)
                    {
                        $newValue .= $separator;
                        $separator = next($separators);
                    }
                    foreach ($masks as $mask) {
                        $lengthMask = strlen($mask);
                        
                        if ($index + $lengthMask > $length)
                        {
                            $sublen = $length - $index;
                        }
                        else
                        {
                            $sublen = $lengthMask;
                        }
                        $newValue .= substr($value, $index, $sublen);
                        
                        if ($separator !== false)
                        {
                            if ($length > $index + $lengthMask || ($length == $index + $lengthMask && $length == $numberOfHash))
                            {
                                $newValue .= $separator;
                                $separator = next($separators);
                            }
                        }
                        $index += $lengthMask;
                    }
                    return $newValue;
                }
                return $value;
            },
        );
    }
}
