<?php

namespace NFSe\Formatter;

/**
 *
 * @author Pedro Marcelo
 */
class PercentualFormatter extends DecimalFormatter
{
    public function format($value)
    {
        if (preg_match("/^([0-9.,%]+)$/", $value))
        {
            $value = $this->replaceComma($value);
            
            if (strpos($value, '%') !== false)
            {
                $value = floatval(strtr($value, array('%' => ''))) / 100;
            }
        }
        return parent::format($value);
    }
    
    private function replaceComma($value)
    {
        $posComma = strpos($value, ',');
        $isPercent = strpos($value, '%') !== false;
        
        if ($isPercent)
        {
            $value = strtr($value, array('%' => ''));
        }
        
        if ($posComma !== false)
        {
            if (strpos($value, '.') !== false)
            {
                if (preg_match("/^((\d{1,2}[,])?([,]?\d{3})+)(\.\d+)$/", $value))
                {
                    $value = strtr($value, array(',' => ''));
                }
                else if (preg_match("/^((\d{1,2}[.])?([.]?\d{3})+)(\,\d+)$/", $value))
                {
                    $value = strtr($value, array('.' => '', ',' => '.'));
                }
            }
            else if(substr_count($value, ',') > 1)
            {
                $value = strtr($value, array(',' => ''));
            }
            else
            {
                $value = strtr($value, array(',' => '.'));
            }
                
        }
        
        if ($isPercent)
        {
            $value .= '%';
        }
        return $value;
    }
}
