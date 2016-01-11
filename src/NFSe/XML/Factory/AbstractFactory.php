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
    
    public function buildEntity(\SimpleXMLElement $xmlElement)
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = $this->getFactoryManager()->getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get($xmlElement->getName());
        foreach ($xmlElement->attributes() as $attribute => $value) {
            
        }
        foreach ($xmlElement->children() as $child) {
            
        }
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
