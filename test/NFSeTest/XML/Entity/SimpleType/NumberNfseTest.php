<?php

namespace NFSeTest\XML\Entity\SimpleType;

/**
 *
 * @author Pedro Marcelo
 */
class NumberNfseTest
{
    public function testSetAttributes()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get('TsNumeroNfse');
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr3', 'value3');
        
        $this->assertEquals(3, count($entity->getAttributes()));
    }
    
    public function testNotSetAttributesWithTheSameName()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get('TsNumeroNfse');
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr2', 'value3');
        
        $this->assertEquals(2, count($entity->getAttributes()));
    }
    
    public function testGetAttribute()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get('TsNumeroNfse');
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr3', 'value3');
        
        $this->assertEquals('value1', $entity->getAttribute('attr1'));
        $this->assertEquals('value2', $entity->getAttribute('attr2'));
        $this->assertEquals('value3', $entity->getAttribute('attr3'));
    }
    
    public function testTryToGetAttributesNotSet()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get('TsNumeroNfse');
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr3', 'value3');
        
        $this->assertNull($entity->getAttribute('attr4'));
        $this->assertFalse($entity->getAttribute('attr5', false));
    }
    
    public function testSetValue()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get('TsNumeroNfse');
        $entity->setValue('Value');
        $this->assertEquals('Value', $entity->getValue());
    }
}
