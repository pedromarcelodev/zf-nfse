<?php

namespace NFSe\Formatter\SimpleType;

use \NFSe\Formatter\NumberFormatter;
use \NFSe\Formatter\FormatterException;

/**
 *
 * @author Pedro Marcelo
 */
class NfseNumberFormatter extends NumberFormatter
{
    /**
     * 
     * @param string $value
     * @return string
     * @throws FormatterException
     */
    public function format($value)
    {
        parent::format($value);
        
        if (preg_match("/^(\d{4})(\d{11})$/", $value, $matches))
        {
            $now = new \DateTime();
            $currentYear = intval($now->format("Y"));
            
            if (intval($matches[1]) <= $currentYear)
            {
                return $value;
            }
            else
            {
                throw new FormatterException(sprintf(
                    "The year is not a current year and not earlier. Informed year: %s",
                    $matches[1]
                ));
            }
        }
        else
        {
            throw new FormatterException(
                "Nfse number is invalid. The valid format is 'AAAANNNNNNNNNNN' where 'AAAA' is the year and NNNNNNNNNNN is a number with 11 digits."
            );
        }
    }
}