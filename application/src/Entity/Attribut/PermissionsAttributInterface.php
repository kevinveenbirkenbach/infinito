<?php

namespace App\Entity\Attribut;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 */
interface PermissionsAttributInterface
{
    public function setPermissions(ArrayCollection $permissions): void;

    public function getPermissions(): ArrayCollection;
}
