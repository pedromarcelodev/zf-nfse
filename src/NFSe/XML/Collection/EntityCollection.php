<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NFSe\XML\Collection;

use \SplQueue;
use \NFSe\XML\Entity\AbstractEntity;
use \Zend\Stdlib\ArraySerializableInterface;

/**
 * Description of EntityCollection
 *
 * @author Pedro Marcelo
 */
class EntityCollection extends SplQueue implements ArraySerializableInterface
{
    /**
     * Returns the first element of collection
     * 
     * @return AbstractEntity|null
     */
    public function first()
    {
        if ($this->isEmpty())
        {
            return null;
        }
        return parent::bottom();
    }
    
    /**
     * Returns the last element of collection
     * 
     * @return AbstractEntity|null
     */
    public function last()
    {
        if ($this->isEmpty())
        {
            return null;
        }
        return parent::top();
    }
    
    /**
     * Pushes an instance of AbstractEntity class at the end
     * 
     * @param AbstractEntity $value
     */
    public function push($value)
    {
        if ($value instanceof AbstractEntity)
        {
            parent::push($value);
        }
    }
    
    /**
     * Sets an instance of AbstractEntity class at the specified index
     * 
     * @param mixed $index
     * @param AbstractEntity $newval
     */
    public function offsetSet($index, $newval)
    {
        if ($newval instanceof AbstractEntity)
        {
            parent::offsetSet($index, $newval);
        }
    }
    
    /**
     * Add a new instance of AbstractEntity class at the specified index
     * 
     * @param mixed $index
     * @param AbstractEntity $newval
     */
    public function add($index, $newval)
    {
        if ($newval instanceof AbstractEntity)
        {
            parent::add($index, $newval);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function exchangeArray(array $array)
    {
        
    }

    /**
     * {@inheritDoc}
     */
    public function getArrayCopy()
    {
        $arr = [];
        
        if (!$this->isEmpty())
        {
            while ($item = $this->current()) {
                $arr[] = $item;
                $this->next();
            }
        }
        
        return $arr;
    }
}