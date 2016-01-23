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
     * @return integer|float
     * @throws FormatterException
     */
    public function format($value)
    {
        if (is_numeric($value))
        {
            $float = floatval($value);
            $integer = intval($value);
            
            if ($integer == $float)
            {
                return $integer;
            }
            else
            {
                return $float;
            }
        }
        else
        {
            throw new FormatterException("The formatted value is not a number");
        }
    }
}
