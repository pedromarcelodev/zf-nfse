<?php

namespace NFSeTest\XML\Factory\SimpleType;

/**
 *
 * @author Pedro Marcelo
 */
class NfseNumberFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFailBuildEntity()
    {
        $xml = file_get_contents(__DIR__ . '/../../../../xml-tests/xmlfail.xml');
        $xmlObject = new \SimpleXMLElement($xml);
        $tagName = $xmlObject->getName();
        try {
            /* @var $factoryManager \NFSe\Service\FactoryManager */
            $factoryManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FactoryManager');
            $factoryManager->get($tagName);
            $this->fail("The '$tagName' tag is mapped");
        } catch (\NFSe\XML\InexistentXMLTagException $ex) {
            $this->assertEquals($ex->getMessage(), "The '$tagName' tag is not mapped");
        }
    }
    
    public function testPassBuildEntity()
    {
        $xml = file_get_contents(__DIR__ . '/../../../../xml-tests/tsnumeronfse-entity.xml');
        $xmlObject = new \SimpleXMLElement($xml);
        $tagName = $xmlObject->getName();
        try {
            /* @var $factoryManager \NFSe\Service\FactoryManager */
            $factoryManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FactoryManager');
            $factory = $factoryManager->get($tagName);
            $entity = $factory->buildEntity($xmlObject);
            $this->assertInstanceOf("\NFSe\XML\Entity\AbstractEntity", $entity);
            $this->assertInstanceOf("\NFSe\XML\Entity\SimpleType\GenericEntity", $entity);
            $this->assertEquals("201612345678901", $entity->getValue());
            $this->assertEquals("value1", $entity->getAttribute('attr1'));
            $this->assertEquals("value2", $entity->getAttribute('attr2'));
        } catch (\NFSe\XML\InexistentXMLTagException $ex) {
            $this->fail("The '$tagName' tag is not mapped");
        }
    }
}
