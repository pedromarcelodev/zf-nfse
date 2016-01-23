<?php

namespace NFSe\XML\Factory;

/**
 *
 * @author Pedro Marcelo
 */
interface FactoryInterface
{
    /**
     * Builds an entity by adding their attributes and children
     * 
     * @param \SimpleXMLElement $xmlElement
     * @return \NFSe\XML\Entity\AbstractEntity
     */
    public function buildEntity(\SimpleXMLElement $xmlElement);
}
