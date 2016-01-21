<?php

namespace NFSe\XML\Entity;

/**
 *
 * @author Pedro Marcelo
 */
abstract class AbstractEntity implements XMLEntityInterface, EntityInterface
{
    /**
     * XML Tag Name
     * 
     * @var string
     */
    protected $tagName;
    
    /**
     * XML Tag Attributes
     * 
     * @var array
     */
    private $attributes = [];
    
    /**
     * {@inheritDoc}
     */
    public function getTagName()
    {
        return $this->tagName;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setAttribute($name, $value)
    {
        if (!isset($this->attributes[$name]))
        {
            $this->attributes[$name] = (string) $value;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAttribute($name, $default = null)
    {
        return (isset($this->attributes[$name]))? $this->attributes[$name] : $default;
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