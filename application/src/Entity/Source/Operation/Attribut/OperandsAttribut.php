<?php

namespace App\Entity\Source\Operation\Attribut;

use Doctrine\Common\Collections\Collection;

trait OperandsAttribut
{
    /**
     * @var Collection
     */
    protected $operands;

    /**
     * @param Collection $collection
     */
    public function setOperands(Collection $operands): void
    {
        $this->operands = $operands;
    }

    /**
     * @return Collection
     */
    public function getOperands(): Collection
    {
        return $this->operands;
    }
}
