<?php

namespace App\Entity\Attribut;

use App\Entity\PermissionInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
trait PermissionsAttribut
{
    /**
     * @var Collection
     */
    protected $permissions;

    public function setPermissions(Collection $permissions): void
    {
        $this->permissions = $permissions;
    }

    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(PermissionInterface $permission): void
    {
        $this->permissions->add($permission);
    }
}
