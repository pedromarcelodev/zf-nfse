<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NFSe\Formatter\SimpleType;

use \NFSe\Formatter\FormatterInterface;
use \NFSe\Formatter\FormatterException;

/**
 * Description of VerificationCodeFormatter
 *
 * @author Pedro Marcelo
 */
class VerificationCodeFormatter implements FormatterInterface
{
    public function format($value)
    {
        $strValue = "$value";
        
        if (strlen($strValue) <= 9)
        {
            return $strValue;
        }
        else
        {
            throw new FormatterException("The value has more than 9 characters");
        }
    }
}
