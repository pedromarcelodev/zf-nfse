<?php

namespace NFSe\XML\Entity;

/**
 *
 * @author Pedro Marcelo
 */
interface XMLEntityInterface
{
    /**
     * Returns an XML representation of this object
     * 
     * @return string
     */
    public function toXML();
}
