<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
abstract class AbstractFormatter implements FormatterInterface
{
    /**
     * Pattern that will be used to format a value
     *
     * @var string
     */
    private $pattern;
    
    /**
     * Sets a new pattern
     * 
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        if (is_string($pattern))
        {
            $this->pattern = $pattern;
        }
        else
        {
            throw new FormatterException("The 'pattern' value must be a string");
        }
    }
    
    /**
     * Returns the pattern used by this formatter
     * 
     * @return string
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
