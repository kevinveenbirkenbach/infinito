<?php

namespace App\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
trait RightsAttribute
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
