<?php

namespace NFSe\Exception;

/**
 * Description of InexistentXMLTagException
 *
 * @author Pedro Marcelo
 */
class InexistentXMLTagException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
