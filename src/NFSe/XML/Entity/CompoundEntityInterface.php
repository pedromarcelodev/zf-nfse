<?php

namespace NFSe\XML\Entity;

/**
 *
 * @author Pedro Marcelo
 */
interface CompoundEntityInterface
{
    /**
     * Add a new child to this entity
     * 
     * @param EntityInterface $entity
     */
    public function addChild(EntityInterface $entity);
    
    /**
     * Returns a child at the specified index if it exists
     * 
     * @param integer $index
     * @return EntityInterface
     */
    public function getChild($index);
    
    /**
     * Returns the children
     * 
     * @return array
     */
    public function getChildren();
}
