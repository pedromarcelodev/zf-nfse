<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NFSeTest\XML\Collection;

use \NFSe\XML\Collection\EntityCollection;
use \NFSe\XML\Entity\ComplexType\GenericComplexTypeEntity;
use \NFSe\XML\Entity\SimpleType\GenericSimpleTypeEntity;

/**
 * Description of EntityCollectionTest
 *
 * @author Pedro Marcelo
 */
class EntityCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testInsertInstancesOfAsbtractEntity()
    {
        $collection = new EntityCollection();
        $collection->push(new GenericComplexTypeEntity());
        $collection->push(new GenericComplexTypeEntity());
        $collection->push(new GenericSimpleTypeEntity(null));
        $this->assertEquals(3, $collection->count());
    }
    
    public function testInsertOnlyInstancesOfAbstractEntity()
    {
        $collection = new EntityCollection();
        $collection->push(new GenericComplexTypeEntity());
        $collection->push('Hello World!');
        $collection->push(new GenericSimpleTypeEntity(null));
        $collection->push(array('Hello Worlds!'));
        $collection->push(1);
        $collection->push(1.2);
        $collection->push(true);
        $this->assertEquals(2, $collection->count());
    }
    
    public function testEmptyCollection()
    {
        $collection = new EntityCollection();
        $this->assertNull($collection->first());
        $this->assertNull($collection->last());
    }
}