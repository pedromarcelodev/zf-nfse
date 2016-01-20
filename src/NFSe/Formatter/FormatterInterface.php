<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
interface FormatterInterface
{
    /**
     * Returns a formatted value
     * 
     * @param mixed $value
     */
    public function format($value);
}
