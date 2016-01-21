<?php

namespace NFSe\XML\Entity;

use \NFSe\Formatter\FormatterInterface;

/**
 *
 * @author Pedro Marcelo
 */
abstract class AbstractXMLEntity extends AbstractEntity implements XMLEntityInterface
{
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
        parent::__construct();
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
}