<?php

namespace App\Entity\Source\Attribut;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\GroupSourceInterface;

/**
 * @author kevinfrantz
 */
trait GroupSourcesAttribut
{
    /**
     * @var Collection|GroupSourceInterface[]
     */
    protected $groups;

    /**
     * @return Collection|GroupSourceInterface[]
     */
    public function getGroupSources(): Collection
    {
        return $this->groups;
    }

    /**
     * @param Collection|GroupSourceInterface[] $groups
     */
    public function setGroupSources(Collection $groups): void
    {
        $this->groups = $groups;
    }
}
