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
        } catch (\NFSe\XML\InexistentXMLTagException $ex) {
            $this->fail("The '$tagName' tag is not mapped");
        }
    }
}
