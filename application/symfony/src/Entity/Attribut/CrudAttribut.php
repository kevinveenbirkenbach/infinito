<?php

namespace App\Entity\Attribut;

/**
 * @todo Implement a trait for crud which substitute this one.
 *
 * @author kevinfrantz
 */
trait CrudAttribut
{
    /**
     * @var string
     */
    protected $crud;

    /**
     * @param string $crud
     */
    public function setCrud(string $crud): void
    {
        $this->crud = $crud;
    }

    /**
     * @return string
     */
    public function getCrud(): string
    {
        return $this->crud;
    }
}
