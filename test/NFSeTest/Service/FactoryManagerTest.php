<?php

namespace NFSeTest\Service;

/**
 * Description of NFSeFactoriesTest
 *
 * @author Pedro Marcelo
 */
class FactoryManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFactoryFromInexistentXmlTagMapped()
    {
        try {
            /* @var $factoryManager \NFSe\Service\FactoryManager */
            $factoryManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FactoryManager');
            $factoryManager->get('TestFail');
            $this->fail("The 'TestFail' tag is mapped");
        } catch (\NFSe\Exception\InexistentXMLTagException $ex) {
            $this->assertEquals($ex->getMessage(), "The 'TestFail' tag is not mapped");
        }
    }
    
    public function testGetFactotyFromExistentXmlTagMapped()
    {
        try {
             /* @var $factoryManager \NFSe\Service\FactoryManager */
            $factoryManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FactoryManager');
            $entity = $factoryManager->get('AbstractTag');
            $this->assertInstanceOf("\NFSe\XML\Factory\AbstractFactory", $entity);
        } catch (\NFSe\Exception\InexistentXMLTagException $ex) {
            $this->fail("The 'AbstractTag' tag is not mapped");
        }
    }
}
