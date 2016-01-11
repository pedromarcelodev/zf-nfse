<?php

namespace NFSe\XML\Entity;

use \NFSe\XML\Collection\EntityCollection;

/**
 * Description of AbstractEntity
 *
 * @author Pedro Marcelo
 */
class AbstractEntity
{
    /**
     * XML Tag Attributes
     * 
     * @var array
     */
    private $attributes = [];
    
    /**
     * Sets a new attribute if $name is not set yet
     * 
     * @param string $name
     * @param string $value
     */
    public function setAttribute($name, $value)
    {
        if (!isset($this->attributes[$name]))
        {
            $this->attributes[$name] = (string) $value;
        }
    }
    
    /**
     * Returns all attributes
     * 
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}