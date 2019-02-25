<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 *
 * @see RightsAttributInterface
 */
trait RightsAttribut
{
    /**
     * @var Collection
     */
    protected $rights;

    /**
     * @param Collection|RightInterface[] $rights
     */
    public function setRights(Collection $rights): void
    {
        $this->rights = $rights;
    }

    /**
     * @return Collection|RightInterface[]
     */
    public function getRights(): Collection
    {
        return $this->rights;
    }
}
