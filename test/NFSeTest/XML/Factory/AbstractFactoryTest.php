<?php

namespace NSFeTest\XML\Factory;

use \NFSe\XML\Factory\AbstractFactory;
use \NFSe\XML\Entity\AbstractEntity;

/**
 * Description of AbstractFactoryTest
 *
 * @author Pedro Marcelo
 */
class AbstractFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFailBuildEntity()
    {
        $xml = file_get_contents(__DIR__ . '/../../../xml-tests/xmlfail.xml');
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
        $xml = file_get_contents(__DIR__ . '/../../../xml-tests/abstractentity.xml');
        $xmlObject = new \SimpleXMLElement($xml);
        $tagName = $xmlObject->getName();
        try {
            /* @var $factoryManager \NFSe\Service\FactoryManager */
            $factoryManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FactoryManager');
            $factory = $factoryManager->get($tagName);
            $entity = $factory->buildEntity($xmlObject);
            $this->assertInstanceOf("\NFSe\XML\Entity\AbstractEntity", $entity);
            $this->assertEquals("", $entity->getValue());
            $this->assertEquals("Value Tag 1", $entity->getChild(0)->getValue());
            $this->assertEquals("valueAT1", $entity->getChild(0)->getAttribute('attr1'));
            $this->assertEquals("Value Tag 2", $entity->getChild(1)->getValue());
            $this->assertEquals("valueAT2", $entity->getChild(1)->getAttribute('attr1'));
            $this->assertEquals("", $entity->getChild(2)->getValue());
            $this->assertEquals("valueAT3", $entity->getChild(2)->getAttribute('attr1'));
        } catch (\NFSe\XML\InexistentXMLTagException $ex) {
            $this->fail("The '$tagName' tag is not mapped");
        }
    }
}
