<?php

namespace App\Entity\Attribut;

use App\Entity\NodeInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
trait ParentsAttribut
{
    /**
     * @var Collection|NodeInterface[]
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
