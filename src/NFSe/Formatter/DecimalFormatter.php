<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
class DecimalFormatter extends NumberFormatter implements PatternInterface
{
    /**
     * Pattern that will be used to format a value
     *
     * @var string
     */
    private $pattern;
    
    /**
     * Returns a float value according to the pattern
     * 
     * @param string $value
     * @return string
     */
    public function format($value)
    {
        $value = parent::format($value);
        $pattern = $this->getPattern();
        $parts = explode('.', $value);
        $integerPart = $parts[0];
        $decimalPart = (isset($parts[1]))? $parts[1] : "";
        $start = "";
        $end = "";

        if (strpos($pattern, "+9") === 0)
        {
            $start = $integerPart;
        }
        else if (preg_match("/^(\d+)/", $pattern, $matches))
        {
            $max = strlen($matches[1]);
            $strlen = strlen($integerPart);
            $length = ($max < $strlen)? $max : $strlen;
            $start = substr($integerPart, $length * -1);
        }
        else
        {
            $start = "0";
        }

        if (strlen($decimalPart) > 0 && preg_match("/\.(\d+)$/", $pattern, $matches))
        {
            $end = ".";
            $max = strlen($matches[1]);
            $strlen = strlen($decimalPart);
            $length = ($max < $strlen)? $max : $strlen;
            $end .= substr($decimalPart, 0, $length);
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
        $this->pattern = $pattern;
    }

    /**
     * {@inheritDoc}
     */
    public function getPattern()
    {
        if (is_null($this->pattern))
        {
            throw new FormatterException("Null pattern");
        }
        return $this->pattern;
    }

}