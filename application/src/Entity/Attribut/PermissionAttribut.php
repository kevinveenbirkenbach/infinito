<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 */
trait PermissionAttribut
{
    /**
     * @var ArrayCollection
     */
    protected $permissions;

    public function setPermissions(ArrayCollection $permissions): void
    {
        $this->permissions = $permissions;
    }

    public function getPermissions(): ArrayCollection
    {
        return $this->permissions;
    }
}
