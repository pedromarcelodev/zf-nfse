<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
class DecimalFormatter extends AbstractFormatter
{
    /**
     * Returns a float value according to the pattern
     * 
     * @param string $value
     * @return float
     */
    public function format($value)
    {
        $pattern = $this->getPattern();
        $integerPart = intval($value);
        $decimalPart = $value - $integerPart;
        $start = "";
        $end = "";

        if (strpos($pattern, "+9") === 0)
        {
            $start = "$integerPart";
        }
        else if (preg_match("/^(\d+)/", $pattern, $matches))
        {
            $max = strlen($matches[1]);
            $strIntegerPart = "$integerPart";
            $strlen = strlen($strIntegerPart);
            $length = ($max < $strlen)? $max : $strlen;
            $start = substr($strIntegerPart, $length * -1);
        }
        else
        {
            $start = "0";
        }

        if ($decimalPart > 0 && preg_match("/\.(\d+)$/", $pattern, $matches))
        {
            $end = ".";
            $max = strlen($matches[1]);
            $strDecimalPart = strtr("$decimalPart", array(
                '0.' => '',
                '0,' => '',
            ));
            $strlen = strlen($strDecimalPart);
            $length = ($max < $strlen)? $max : $strlen;
            $end .= substr($strDecimalPart, 0, $length);
        }
        return floatval($start . $end);
    }
    
    /**
     * Sets a value pattern for the decimal type
     * 
     * @param string $pattern
     * @throws FormatterException
     */
    public function setPattern($pattern)
    {
        if (!preg_match("/^((\+9|[9]+)(\.[9]+)?)$/", $pattern))
        {
            throw new FormatterException("Invalid pattern '$pattern'. Read documentation for more information.");
        }
        parent::setPattern($pattern);
    }
}