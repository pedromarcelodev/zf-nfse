<?php

namespace NFSe\XML\Entity;

use \NFSe\XML\Entity\ComplexType\GenericEntity;

/**
 *
 * @author Pedro Marcelo
 */
class RootEntity extends GenericEntity
{
    /**
     * {@inheritDoc}
     */
    public function toXML()
    {
        $str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        
        if ($this->getCountChildren() > 0)
        {
            $children = $this->getChildren();
            /* @var $child AbstractEntity */
            foreach ($children as $child) {
                $str .= $child->toXML();
            }
        }
        return $str;
    }
}
