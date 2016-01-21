<?php

namespace NFSe\XML\Entity\ComplexType;

use \NFSe\XML\Entity\CompoundEntityInterface;
use \NFSe\XML\Entity\EntityInterface;
use \NFSe\XML\Entity\AbstractEntity;
use \NFSe\XML\Collection\EntityCollection;

/**
 *
 * @author Pedro Marcelo
 */
class GenericComplexTypeEntity extends AbstractEntity implements CompoundEntityInterface
{
    /**
     * Collection of children
     *
     * @var EntityCollection
     */
    private $children;
    
    public function __construct()
    {
        $this->children = new EntityCollection();
    }
    
    /**
     * {@inheritDoc}
     */
    public function addChild(EntityInterface $entity)
    {
        $this->children->push($entity);
    }

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function toXML()
    {
        
    }

}
