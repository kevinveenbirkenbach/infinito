<?php

namespace Infinito\Entity\Source\Operation\Attribut;

use Doctrine\Common\Collections\Collection;

interface OperandsAttributInterface
{
    /**
     * @param Collection $collection
     */
    public function setOperands(Collection $operands): void;

    /**
     * @return Collection
     */
    public function getOperands(): Collection;
}
