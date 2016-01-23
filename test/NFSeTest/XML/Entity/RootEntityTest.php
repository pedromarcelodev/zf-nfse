<?php

namespace NFSeTest\XML\Entity;

use \NFSe\XML\Entity\RootEntity;

/**
 * Description of RootEntityTest
 *
 * @author Pedro Marcelo
 */
class RootEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testParseObjectToXML()
    {
    	$xml = file_get_contents(__DIR__ . '/../../../xml-tests/simple.xml');
        $root = new RootEntity();
        $stringExpected = preg_replace("/([\s]*)(<[^>]+>)([\s]*)/", "$2", $xml);
        $this->assertEquals($stringExpected, $root->toXML());
    }
    
    public function testAddChild()
    {
        /* @var $entityManager \NFSe\Service\EntityManager */
        $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
        $root = new RootEntity();
        $entity2 = $entityManager->get('TsNumeroNfse');
        $entity2->setAttribute('attr2', 'value2');
        $entity3 = $entityManager->get('TsNumeroNfse');
        $entity3->setAttribute('attr3', 'value3');
        
        $root->addChild($entity2);
        $root->addChild($entity3);
        
        $this->assertEquals(2, $root->getCountChildren());
        $this->assertEquals('value2', $root->getChild(0)->getAttribute('attr2'));
        $this->assertEquals('value3', $root->getChild(1)->getAttribute('attr3'));
    }
}