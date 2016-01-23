<?php

namespace NFSe\XML\Entity;

use \NFSe\Formatter\FormatterInterface;

/**
 *
 * @author Pedro Marcelo
 */
interface SimpleEntityInterface
{
    public function __construct(FormatterInterface $formatter);
    
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
