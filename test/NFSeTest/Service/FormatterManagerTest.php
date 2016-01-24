<?php

namespace NFSeTest\Service;

/**
 *
 * @author Pedro Marcelo
 */
class FormatterManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testHasAndGetFormatter()
    {
        /* @var $formatterManager \NFSe\Service\NFSeLocatorInterface */
        $formatterManager = \NFSeTest\Bootstrap::getServiceManager()->get('NFSe\Service\FormatterManager');
        $this->assertTrue($formatterManager->has('NFSe\Formatter\Number'));
        $formatter = $formatterManager->get('NFSe\Formatter\Number');
        $this->assertEquals(1, $formatter->format('1'));
        $this->setExpectedException('\NFSe\Formatter\FormatterException', 'The formatted value is not a number');
        $formatter->format('a');
    }
}
