<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NFSe\XML\Entity\SimpleType;

use \NFSe\XML\Entity\SimpleEntityInterface;
use \NFSe\XML\Entity\AbstractEntity;
use \NFSe\Formatter\FormatterInterface;

/**
 * Description of GenericSimpleTypeEntity
 *
 * @author Pedro Marcelo
 */
class GenericEntity extends AbstractEntity implements SimpleEntityInterface
{
    
    /**
     * XML Tag Value
     *
     * @var mixed
     */
    private $value = "";
    
    /**
     * 
     * @var FormatterInterface
     */
    private $formatter;
    
    /**
     * 
     * @param FormatterInterface $formatter
     */
    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }
    
    /**
     * 
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }
    
    /**
     * 
     * @return FormatterInterface
     */
    public function getFormatter()
    {
        return $this->formatter;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        $this->value = $this->getFormatter()->format($value);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toXML()
    {
        
    }
}