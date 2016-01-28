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
                $posDot = strpos($value, '.');
                $value = strtr($value, array('%' => '', '.' => ''));
                $newPosDot = $posDot !== false? $posDot - 2 : strlen($value) - 2;
                
                if ($newPosDot > 0)
                {
                    $newValue = substr($value, 0, $newPosDot);
                    $newValue .= "." . substr($value, $newPosDot);
                }
                else
                {
                    $newValue = "0." . str_repeat("0", abs($newPosDot)) . $value;
                }
                $value = $newValue;
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
