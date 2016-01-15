<?php

namespace NFSeTest\Service;

use \NFSeTest\Service\InexistentPatternValueException;

/**
 * Description of PatternManagerTest
 *
 * @author Pedro Marcelo
 */
class PatternManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testAddANewPatternItem()
    {
        /* @var $patternManager \NFSe\Service\PatternManager */
        $patternManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\PatternManager');
        $this->assertTrue($patternManager->addPatternItem('unit-test', ['pattern' => '']));
        $this->assertFalse($patternManager->addPatternItem('date', ['pattern' => '']));
        $this->assertFalse($patternManager->addPatternItem('datetime', ['pattern' => '']));
    }
    
    public function testUsingExistentPattern()
    {
        try {
            /* @var $patternManager \NFSe\Service\PatternManager */
            $patternManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\PatternManager');
            $value1 = $patternManager->getValue('decimal', 152.747273);
            $value2 = $patternManager->getValue('percent', 152.747273);
            $this->assertEquals(152.74, $value1);
            $this->assertEquals(152.7472, $value2);
        } catch (InexistentPatternValueException $ex) {
            $this->fail($ex->getMessage());
        }
    }
    
    public function testUsingNonexistentPattern()
    {
        try {
            /* @var $patternManager \NFSe\Service\PatternManager */
            $patternManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\PatternManager');
            $value = $patternManager->getValue('unit-test2', 2.0);
            $this->fail("The 'unit-test2' was added to the patterns");
        } catch (InexistentPatternValueException $ex) {
            $this->assertEquals("The 'unit-test2' was not added to the patterns", $ex->getMessage());
        }
    }
    
    public function testAllValueTypes()
    {
        try {
            /* @var $patternManager \NFSe\Service\PatternManager */
            $patternManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\PatternManager');
            $this->assertTrue($patternManager->addPatternItem('decimal2', [
                'pattern' => '+9.9',
                'type' => 'float',
            ]));
            $this->assertTrue($patternManager->addPatternItem('decimal3', [
                'pattern' => '+9',
                'helper' => 'float',
            ]));
            $this->assertTrue($patternManager->addPatternItem('decimal4', [
                'pattern' => '99.9',
                'type' => 'float',
            ]));
            $this->assertTrue($patternManager->addPatternItem('cpf-mask', [
                'pattern' => '###.###.###-##',
                'type' => 'mask',
            ]));
            $this->assertTrue($patternManager->addPatternItem('phone-mask', [
                'pattern' => '(##) ####-####',
                'type' => 'mask',
            ]));
            $this->assertTrue($patternManager->addPatternItem('random-mask', [
                'pattern' => '##.##-#### (###)',
                'type' => 'mask',
            ]));
            $value1 = $patternManager->getValue('decimal', 152.747273);
            $value2 = $patternManager->getValue('percent', 152.747273);
            $value3 = $patternManager->getValue('decimal2', 152.747273);
            $value4 = $patternManager->getValue('decimal3', 152.747273);
            $value5 = $patternManager->getValue('decimal4', 152.747273);
            $value6 = $patternManager->getValue('date', "2015-02-12");
            $value7 = $patternManager->getValue('datetime', "2015-02-12T18:50:00");
            $value8 = $patternManager->getValue('cpf-mask', "99999999999");
            $value9 = $patternManager->getValue('cpf-mask', "9999999999");
            $value10 = $patternManager->getValue('cpf-mask', "999999999");
            $value11 = $patternManager->getValue('cpf-mask', "9999999");
            $value12 = $patternManager->getValue('phone-mask', "9999999999");
            $value13 = $patternManager->getValue('random-mask', "99999999999");
            
            $this->assertEquals(152.74, $value1);
            $this->assertEquals(152.7472, $value2);
            $this->assertEquals(152.7, $value3);
            $this->assertEquals(152, $value4);
            $this->assertEquals(52.7, $value5);
            $this->assertTrue($value6 instanceof \DateTime && $value6->format("d/m/Y") == "12/02/2015");
            $this->assertTrue($value7 instanceof \DateTime && $value7->format("d/m/Y\TH:i:s") == "12/02/2015T18:50:00");
            $this->assertEquals("999.999.999-99", $value8);
            $this->assertEquals("999.999.999-9", $value9);
            $this->assertEquals("999.999.999", $value10);
            $this->assertEquals("999.999.9", $value11);
            $this->assertEquals("(99) 9999-9999", $value12);
            $this->assertEquals("99.99-9999 (999)", $value13);
        } catch (InexistentPatternValueException $ex) {
            $this->fail($ex->getMessage());
        }
    }
}
