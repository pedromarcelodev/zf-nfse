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
}