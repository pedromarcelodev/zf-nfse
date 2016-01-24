<?php

namespace NFSeTest\Formatter\SimpleType;

use \NFSe\Formatter\FormatterException;

/**
 *
 * @author Pedro Marcelo
 */
class VerificationCodeFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatValue()
    {
        /* @var $formatterManager \NFSe\Service\FormatterManager */
        $formatterManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FormatterManager');
        $formatter = $formatterManager->get('NFSe\Formatter\VerificationCode');
        $this->assertEquals("abc", $formatter->format("abc"));
        $this->assertEquals("abcdef", $formatter->format("abcdef"));
        $this->assertEquals("abcdefghi", $formatter->format("abcdefghi"));
        
        try {
            $formatter->format("abcdefghijkl");
            $message = "";
        } catch (FormatterException $ex) {
            $message = $ex->getMessage();
        }
        
        $this->assertEquals("The value has more than 9 characters", $message);
    }
}
