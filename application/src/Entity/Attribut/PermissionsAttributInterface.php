<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\PermissionInterface;

/**
 * @author kevinfrantz
 */
interface PermissionsAttributInterface
{
    public function setPermissions(ArrayCollection $permissions): void;

    public function getPermissions(): ArrayCollection;

    public function addPermission(PermissionInterface $permission): void;
}
