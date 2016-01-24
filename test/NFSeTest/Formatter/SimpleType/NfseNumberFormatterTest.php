<?php

namespace NFSeTest\Formatter\SimpleType;

use \NFSe\Formatter\FormatterException;

/**
 *
 * @author Pedro Marcelo
 */
class NfseNumberFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatValue()
    {
        /* @var $formatterManager \NFSe\Service\FormatterManager */
        $formatterManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FormatterManager');
        $formatter = $formatterManager->get('NFSe\Formatter\NFSeNumber');
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
