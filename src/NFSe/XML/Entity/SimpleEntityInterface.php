<?php

namespace NFSe\XML\Entity;

/**
 *
 * @author Pedro Marcelo
 */
interface SimpleEntityInterface
{
    /**
     * Sets a value to this entity
     * 
     * @param mixed $value
     */
    public function setValue($value);
    
    /**
     * Returns the entity's value
     * 
     * @return mixed
     */
    public function getValue();
}
