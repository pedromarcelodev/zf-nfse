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
    
    public function testParseObjectToXML()
    {
    	$xml = file_get_contents(__DIR__ . '/../../../xml-tests/abstractentity.xml');
        $xmlObject = new \SimpleXMLElement($xml);
    }
}