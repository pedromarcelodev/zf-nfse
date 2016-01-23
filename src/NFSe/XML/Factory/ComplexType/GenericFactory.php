<?php

namespace NFSe\XML\Factory\ComplexType;

use \NFSe\XML\Factory\AbstractFactory;

/**
 *
 * @author Pedro Marcelo
 */
class GenericFactory extends AbstractFactory
{
    /**
     * 
     * @param \SimpleXMLElement $xmlElement
     * @return \NFSe\XML\Entity\ComplexType\GenericEntity
     */
    public function buildEntity(\SimpleXMLElement $xmlElement)
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = $this->getFactoryManager()->getServiceLocator()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get($xmlElement->getName());
        foreach ($xmlElement->attributes() as $attribute => $value) {
            $entity->setAttribute($attribute, (string) $value);
        }
        
        if ($xmlElement->count() > 0)
        {
            $children = $xmlElement->children();
            foreach ($children as $child) {
                $factory = $this->getFactoryManager()->get($child->getName());
                $entity->addChild($factory->buildEntity($child));
            }
        }
        return $entity;
    }
}
