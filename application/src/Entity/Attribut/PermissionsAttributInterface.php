<?php

namespace App\Entity\Attribut;

use App\Entity\PermissionInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface PermissionsAttributInterface
{
    public function setPermissions(Collection $permissions): void;

    public function getPermissions(): Collection;

    public function addPermission(PermissionInterface $permission): void;
}
