<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
trait ParentsAttribut
{
    /**
     * @var Collection|ParentsAttributInterface[]
     */
    protected $parents;

    public function getParents(): Collection
    {
        return $this->parents;
    }

    public function setParents(Collection $parents): void
    {
        $this->parents = $parents;
    }
}
