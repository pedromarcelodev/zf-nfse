<?php

namespace NFSeTest\Formatter\SimpleType;

use \NFSe\Formatter\FormatterException;

/**
 *
 * @author Pedro Marcelo
 */
class StatusFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatValue()
    {
        /* @var $formatterManager \NFSe\Service\FormatterManager */
        $formatterManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FormatterManager');
        $formatter = $formatterManager->get('NFSe\Formatter\Status');
        $this->assertEquals(1, $formatter->format("1"));
        $this->assertEquals(2, $formatter->format("2"));
        $this->assertEquals("Normal", $formatter->getStatusName("1"));
        $this->assertEquals("Canceled", $formatter->getStatusName("2"));
        
        try {
            $formatter->format("-1");
            $this->fail("Status '-1' was accepted");
        } catch (FormatterException $ex) {
            $this->assertEquals("This status not exists", $ex->getMessage());
        }
    }
}
