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
     * Collection of children
     *
     * @var EntityCollection
     */
    private $children;
    
    /**
     * XML Tag Value
     *
     * @var mixed
     */
    private $value;
    
    public function __construct()
    {
        $this->children = new EntityCollection();
    }
    
    /**
     * Returns the XML tag name
     * 
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }
    
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
     * 
     * @param string $name
     * @param mixed $default
     * @return string
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
    
    /**
     * Add a new child to this entity
     * 
     * @param AbstractEntity $entity
     */
    public function addChild(AbstractEntity $entity)
    {
        $this->children->push($entity);
    }
    
    /**
     * Returns a child at the specified index if it exists
     * 
     * @param integer $index
     * @return AbstractEntity
     */
    public function getChild($index)
    {
        if ($this->children->isEmpty() || !$this->children->offsetExists($index))
        {
            return null;
        }
        return $this->children->offsetGet($index);
    }
    
    /**
     * Returns the children
     * 
     * @return array
     */
    public function getChildren()
    {
        return $this->children->getArrayCopy();
    }
    
    /**
     * Returns the number of children
     * 
     * @return integer
     */
    public function getCountChildren()
    {
        return $this->children->count();
    }
    
    /**
     * Sets a value to this entity
     * 
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    /**
     * Returns the entity's value
     * 
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}