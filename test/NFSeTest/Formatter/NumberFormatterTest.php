<?php

namespace NFSeTest\Formatter;

use \NFSe\Formatter\FormatterException;

/**
 *
 * @author Pedro Marcelo
 */
class NumberFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatValue()
    {
        /* @var $numberFormatter \NFSe\Formatter\FormatterInterface */
        $numberFormatter = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Formatter\Number');
        $this->assertEquals(1234, $numberFormatter->format("1234"));
        $this->assertEquals(1234, $numberFormatter->format("0001234"));
        $this->assertEquals(10001234, $numberFormatter->format("10001234"));
        $this->assertEquals(1234.23, $numberFormatter->format("0001234.23"));
        
        try {
            $numberFormatter->format("1b234");
            $message = "";
        } catch (FormatterException $ex) {
            $message = $ex->getMessage();
        }
        $this->assertEquals("The formatted value is not a number", $message);
        
        try {
            $numberFormatter->format(true);
            $message = "";
        } catch (FormatterException $ex) {
            $message = $ex->getMessage();
        }
        $this->assertEquals("The formatted value is not a number", $message);
        
        try {
            $numberFormatter->format(array());
            $message = "";
        } catch (FormatterException $ex) {
            $message = $ex->getMessage();
        }
        $this->assertEquals("The formatted value is not a number", $message);
    }
}
