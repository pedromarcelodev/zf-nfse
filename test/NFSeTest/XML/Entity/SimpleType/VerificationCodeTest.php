<?php

namespace NFSeTest\XML\Entity\SimpleType;

/**
 *
 * @author Pedro Marcelo
 */
class VerificationCodeTest extends \PHPUnit_Framework_TestCase
{
    const TAG_NAME = 'tsCodigoVerificacao';
    
    const CLASS_NAME = '\NFSe\XML\Entity\SimpleType\VerificationCode';
    
    const VALID_VALUE = '123456789';
    
    const INVALID_VALUE = '1234567890';
    
    const EXPECTED_EXCEPTION1 = '\NFSe\Formatter\FormatterException';
    
    public function testIsInstanceOf()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get(self::TAG_NAME);
        $this->assertTrue(class_exists(self::CLASS_NAME));
        $this->assertInstanceOf(self::CLASS_NAME, $entity);
    }
    
    public function testSetAttributes()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get(self::TAG_NAME);
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr3', 'value3');
        
        $this->assertEquals(3, count($entity->getAttributes()));
    }
    
    public function testNotSetAttributesWithTheSameName()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get(self::TAG_NAME);
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr2', 'value3');
        
        $this->assertEquals(2, count($entity->getAttributes()));
    }
    
    public function testGetAttribute()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get(self::TAG_NAME);
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
        $entity = $entityManager->get(self::TAG_NAME);
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr3', 'value3');
        
        $this->assertNull($entity->getAttribute('attr4'));
        $this->assertFalse($entity->getAttribute('attr5', false));
    }
    
    /**
     * 
     */
    public function testSetValue()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $entity = $entityManager->get(self::TAG_NAME);
        $entity->setValue(self::VALID_VALUE);
        $this->assertEquals('123456789', $entity->getValue());
        $this->setExpectedException(self::EXPECTED_EXCEPTION1);
        $entity->setValue(self::INVALID_VALUE);
    }
}
