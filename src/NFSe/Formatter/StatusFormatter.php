<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
class StatusFormatter extends NumberFormatter
{
    const NORMAL = 1;
    
    const CANCELED = 2;
    
    /**
     * The accepted statuses and their nomenclature
     *
     * @var array
     */
    protected $statuses = [
        1 => 'Normal',
        2 => 'Canceled',
    ];
    
    public function format($value)
    {
        $value = parent::format($value);
        $validStatuses = [1, 2];
        
        if (in_array($value, $validStatuses))
        {
            return $value;
        }
        else
        {
            throw new FormatterException("This status not exists");
        }
    }
    
    /**
     * Returns the status name
     * 
     * @param string $value
     * @return string
     */
    public function getStatusName($value)
    {
        $index = $this->format($value);
        return $this->statuses[$index];
    }
}
