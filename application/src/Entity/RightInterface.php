<?php

namespace App\Entity;

use App\Entity\Attribut\TypeAttributInterface;
use App\Entity\Attribut\LawAttributInterface;
use App\Entity\Attribut\PermissionsAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends TypeAttributInterface, LawAttributInterface, PermissionsAttributInterface
{
    public function isGranted(NodeInterface $node): bool;
}
