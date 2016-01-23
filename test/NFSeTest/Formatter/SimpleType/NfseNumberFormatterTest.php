<?php

namespace NFSeTest\Formatter\SimpleType;

use \NFSe\Formatter\FormatterException;
use \NFSe\Formatter\SimpleType\NfseNumberFormatter;

/**
 *
 * @author Pedro Marcelo
 */
class NfseNumberFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatValue()
    {
        /* @var $formatter \NFSe\Formatter\FormatterInterface */
        $formatter = \NFSeTest\Bootstrap::getServiceManager()->get("NFSe\Formatter\NFSeNumber");
        $this->assertEquals("201412345678901", $formatter->format("201412345678901"));
        $this->assertEquals("201512345678901", $formatter->format("201512345678901"));
        $this->assertEquals("201612345678901", $formatter->format("201612345678901"));
        
        try {
            $formatter->format("201712345678901");
            $this->fail("2017 was accepted");
        } catch (FormatterException $ex) {
            $this->assertEquals("The year is not a current year and not earlier. Informed year: 2017", $ex->getMessage());
        }
        
        try {
            $formatter->format("201712345601");
            $this->fail("The invalid format was accepted");
        } catch (FormatterException $ex) {
            $this->assertEquals(
                "Nfse number is invalid. The valid format is 'AAAANNNNNNNNNNN' where 'AAAA' is the year and NNNNNNNNNNN is a number with 11 digits.",
                $ex->getMessage()
            );
        }
    }
}
