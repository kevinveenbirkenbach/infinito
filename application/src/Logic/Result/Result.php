<?php
namespace App\Logic\Result;

/**
 *
 * @author kevinfrantz
 *        
 */
class Result implements ResultInterface
{
    /**
     * @var bool
     */
    protected $bool;
    
    /**
     * The concrete result value
     * @var mixed
     */
    protected $value;

    public function getValue()
    {
        return $this->value;
    }

    public function getBool(): bool
    {
        return $this->bool;
    }
    
    public function setBool(bool $bool): void
    {
        $this->bool = $bool;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }
    
    public function setAll($value): void
    {
        $this->bool = (bool)$value;
        $this->value = $value;
    }

}

