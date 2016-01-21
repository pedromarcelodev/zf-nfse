<?php

namespace NFSe\XML\Entity;

/**
 *
 * @author Pedro Marcelo
 */
interface EntityInterface
{
    /**
     * Returns the XML tag name
     * 
     * @return string
     */
    public function getTagName();
    
    /**
     * Sets a new attribute if $name is not set yet
     * 
     * @param string $name
     * @param string $value
     */
    public function setAttribute($name, $value);
    
    /**
     * 
     * @param string $name
     * @param mixed $default
     * @return string
     */
    public function getAttribute($name, $default = null);
}
