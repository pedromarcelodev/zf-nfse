<?php

namespace NFSeTest\XML\Entity;

use NFSe\XML\Entity\AbstractEntity;

/**
 * Description of AbstractEntityTest
 *
 * @author Pedro Marcelo
 */
class AbstractEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAttributes()
    {
        $entity = new AbstractEntity();
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr3', 'value3');
        
        $this->assertEquals(3, count($entity->getAttributes()));
    }
    
    public function testNotSetAttributesWithTheSameName()
    {
        $entity = new AbstractEntity();
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr2', 'value3');
        
        $this->assertEquals(2, count($entity->getAttributes()));
    }
    
    public function testGetAttribute()
    {
        $entity = new AbstractEntity();
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr3', 'value3');
        
        $this->assertEquals('value1', $entity->getAttribute('attr1'));
        $this->assertEquals('value2', $entity->getAttribute('attr2'));
        $this->assertEquals('value3', $entity->getAttribute('attr3'));
    }
    
    public function testTryToGetAttributesNotSet()
    {
        $entity = new AbstractEntity();
        $entity->setAttribute('attr1', 'value1');
        $entity->setAttribute('attr2', 'value2');
        $entity->setAttribute('attr3', 'value3');
        
        $this->assertNull($entity->getAttribute('attr4'));
        $this->assertFalse($entity->getAttribute('attr5', false));
    }
    
    public function testAddChild()
    {
        $entity = new AbstractEntity();
        $entity->setAttribute('attr1', 'value1');
        $entity2 = new AbstractEntity();
        $entity2->setAttribute('attr2', 'value2');
        $entity3 = new AbstractEntity();
        $entity3->setAttribute('attr3', 'value3');
        
        $entity->addChild($entity2);
        $entity->addChild($entity3);
        
        $this->assertEquals(2, $entity->getCountChildren());
        $this->assertEquals('value2', $entity->getChild(0)->getAttribute('attr2'));
        $this->assertEquals('value3', $entity->getChild(1)->getAttribute('attr3'));
    }
    
    public function testParseObjectToXML()
    {
    	$xml = file_get_contents(__DIR__ . '/../../../xml-tests/abstractentity.xml');
        $xmlObject = new \SimpleXMLElement($xml);
    }
}