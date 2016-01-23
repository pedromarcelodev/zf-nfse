<?php

namespace NFSe\XML\Factory;

use \NFSe\Service\FactoryManager;

/**
 *
 * @author Pedro Marcelo
 */
abstract class AbstractFactory implements FactoryInterface
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
    protected $entityTagName = '';
    
    public function __construct(FactoryManager $nfseFactoryManager)
    {
        $this->factoryManager = $nfseFactoryManager;
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
