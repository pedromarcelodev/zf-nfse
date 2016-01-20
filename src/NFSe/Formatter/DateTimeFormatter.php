<?php

namespace NFSe\Formatter;

use \DateTime;

/**
 *
 * @author Pedro Marcelo
 */
class DateTimeFormatter extends AbstractFormatter
{
    /**
     * Returns a DateTime instance according to the value
     * 
     * @param mixed $value
     * @return \DateTime
     * @throws FormatterException
     */
    public function format($value)
    {
        $pattern = $this->getPattern();
        $datetime = DateTime::createFromFormat($pattern, $value);
        
        if ($datetime === false)
        {
            throw new FormatterException("Value does not match to the pattern");
        }
        return $datetime;
    }
}