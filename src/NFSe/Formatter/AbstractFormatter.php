<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
abstract class AbstractFormatter implements FormatterInterface, PatternInterface
{
    /**
     * Pattern that will be used to format a value
     *
     * @var string
     */
    private $pattern;
    
    /**
     * {@inheritDoc}
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
