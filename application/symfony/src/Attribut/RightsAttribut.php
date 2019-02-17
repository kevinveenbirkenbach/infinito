<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;

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

    public function setRights(Collection $rights): void
    {
        $this->rights = $rights;
    }

    public function getRights(): Collection
    {
        return $this->rights;
    }
}
