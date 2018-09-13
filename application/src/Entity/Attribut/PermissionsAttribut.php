<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\PermissionInterface;

/**
 * @author kevinfrantz
 */
trait PermissionsAttribut
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

    public function addPermission(PermissionInterface $permission): void
    {
        $this->permissions->add($permission);
    }
}
