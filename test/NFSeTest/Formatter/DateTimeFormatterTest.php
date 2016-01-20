<?php

namespace NFSeTest\Formatter;

use \NFSe\Formatter\DateTimeFormatter;
use \NFSe\Formatter\FormatterException;

/**
 *
 * @author Pedro Marcelo
 */
class DateTimeFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatValue()
    {
        $datetimeFormatter = new DateTimeFormatter();
        $datetimeFormatter->setPattern('Y-m-d');
        $datetime1 = $datetimeFormatter->format('2016-01-20');
        $this->assertInstanceOf('\DateTime', $datetime1);
        $this->assertEquals("20/01/2016", $datetime1->format('d/m/Y'));
        $datetimeFormatter->setPattern('Y-m-d\TH:i:s');
        $datetime2 = $datetimeFormatter->format('2016-01-20T12:00:51');
        $this->assertInstanceOf('\DateTime', $datetime2);
        $this->assertEquals("20/01/2016 12:00:51", $datetime2->format('d/m/Y H:i:s'));
        try {
            $datetimeFormatter->setPattern('y-m-d');
            $datetimeFormatter->format('2016-01-20');
            $this->fail("The FormatterException was not thrown");
        } catch (FormatterException $ex) {
            $this->assertEquals("Value does not match to the pattern", $ex->getMessage());
        }
        
    }
}
