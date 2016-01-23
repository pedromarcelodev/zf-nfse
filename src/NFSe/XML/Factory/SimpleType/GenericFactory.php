<?php

namespace NFSe\XML\Factory\SimpleType;

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
     * @return \NFSe\XML\Entity\SimpleType\GenericEntity
     */
    public function buildEntity(\SimpleXMLElement $xmlElement)
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = $this->getFactoryManager()->getServiceLocator()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get($xmlElement->getName());
        foreach ($xmlElement->attributes() as $attribute => $value) {
            $entity->setAttribute($attribute, (string) $value);
        }
        
        if ($xmlElement->count() === 0)
        {
            $entity->setValue((string) $xmlElement);
        }
        return $entity;
    }
}
