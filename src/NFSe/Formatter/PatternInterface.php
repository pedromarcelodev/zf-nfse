<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
interface PatternInterface
{
    /**
     * Sets a new pattern
     * 
     * @param string $pattern
     */
    public function setPattern($string);
    
    /**
     * Returns the pattern used by this formatter
     * 
     * @return string
     */
    public function getPattern();
}
