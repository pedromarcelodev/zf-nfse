<?php

namespace NFSe\XML\Entity;

/**
 * Description of RootEntity
 *
 * @author Pedro Marcelo
 */
class RootEntity extends AbstractXMLEntity
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
            /* @var $child AbstractXMLEntity */
            foreach ($children as $child) {
                $str .= $child->toXML();
            }
        }
        return $str;
    }
}
