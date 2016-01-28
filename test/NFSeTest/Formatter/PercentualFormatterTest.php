<?php

namespace NFSeTest\Formatter;

use \NFSe\Formatter\FormatterException;

/**
 *
 * @author Pedro Marcelo
 */
class PercentualFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatValue()
    {
        /* @var $formatterManager \NFSe\Service\FormatterManager */
        $formatterManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FormatterManager');
        $formatter = $formatterManager->get('NFSe\Formatter\Percentual');
        $formatter->setPattern('9.9999');
        $this->assertEquals('0.259', $formatter->format('25.90%'));
        $this->assertEquals('1', $formatter->format('100%'));
        $this->assertEquals('1.2334', $formatter->format('123,345%'));
        $this->assertEquals('0.259', $formatter->format('25,90%'));
        $this->assertEquals('0.1293', $formatter->format('12,938294%'));
        $this->assertEquals('0.0129', $formatter->format('1,2938294%'));
        $this->assertEquals('0.1293', $formatter->format('0.12938294'));
        $this->assertEquals('0.1293', $formatter->format('0,12938294'));
        $this->setExpectedException("\NFSe\Formatter\FormatterException", "The formatted value is not a number");
        $formatter->format('a');
    }
    
    public function testEmptyPattern()
    {
        try {
            /* @var $formatterManager \NFSe\Service\FormatterManager */
            $formatterManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FormatterManager');
            $formatter = $formatterManager->get('NFSe\Formatter\Percentual');
            $formatter->format(9.992739);
            $this->fail("Null pattern was used");
        } catch (FormatterException $ex) {
            $this->assertEquals("Null pattern", $ex->getMessage());
        }        
    }
}
