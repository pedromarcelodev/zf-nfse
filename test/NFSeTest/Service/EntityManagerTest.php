<?php

namespace NFSeTest\Service;

/**
 * Description of NFSeEntityManager
 *
 * @author Pedro Marcelo
 */
class EntityManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetEntityFromInexistentXmlTagMapped()
    {
        try {
            /* @var $entityManager \NFSe\Service\EntityManager */
            $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
            $entityManager->get('TestFail');
            $this->fail("The 'TestFail' tag is mapped");
        } catch (\NFSe\XML\InexistentXMLTagException $ex) {
            $this->assertEquals($ex->getMessage(), "The 'TestFail' tag is not mapped");
        }
    }
    
    public function testGetEntityFromExistentXmlTagMapped()
    {
        try {
            /* @var $entityManager \NFSe\Service\EntityManager */
            $entityManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\EntityManager');
            $entity = $entityManager->get('AbstractTag');
            $this->assertInstanceOf("\NFSe\XML\Entity\AbstractEntity", $entity);
        } catch (\NFSe\XML\InexistentXMLTagException $ex) {
            $this->fail("The 'AbstractTag' tag is not mapped");
        }
    }
}
