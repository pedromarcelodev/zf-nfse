<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
class NumberFormatter implements FormatterInterface
{
    /**
     * 
     * @param string|integer|float $value
     * @return string
     * @throws FormatterException
     */
    public function format($value)
    {
        if (is_numeric($value))
        {
            $value = preg_replace("/(^[0]+|[.?0]+$)/", "", "$value");
            return $value;
        }
        else
        {
            throw new FormatterException("The formatted value is not a number");
        }
    }
}
