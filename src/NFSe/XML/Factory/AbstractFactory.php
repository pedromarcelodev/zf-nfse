<?php

namespace NFSe\XML\Factory;

use \NFSe\Service\FactoryManager;

/**
 * Description of AbstractFactory
 *
 * @author Pedro Marcelo
 */
class AbstractFactory
{
    /**
     * NFSe entity factory manager
     *
     * @var FactoryManager
     */
    private $factoryManager;
    
    /**
     *
     * @var string
     */
    protected $entityTagName = 'AbstractTag';
    
    public function __construct(FactoryManager $nfseFactoryManager)
    {
        $this->factoryManager = $nfseFactoryManager;
    }
    
    /**
     * Builds an entity by adding their attributes and children
     * 
     * @param \SimpleXMLElement $xmlElement
     * @return \NFSe\XML\Entity\AbstractEntity
     */
    public function buildEntity(\SimpleXMLElement $xmlElement)
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = $this->getFactoryManager()->getServiceManager()->get('NFSe\Service\EntityManager');
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
        else
        {
            $entity->setValue((string) $xmlElement);
        }
        return $entity;
    }
    
    /**
     * Returns an entity factory manager
     * 
     * @return FactoryManager
     */
    protected function getFactoryManager()
    {
        return $this->factoryManager;
    }
}
