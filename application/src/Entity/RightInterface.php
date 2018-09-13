<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\TypeAttributInterface;
use App\Entity\Attribut\LawAttributInterface;

/**
 * @author kevinfrantz
 */
interface RightInterface extends TypeAttributInterface, LawAttributInterface
{
    public function isGranted(NodeInterface $node): bool;

    public function setPermissions(ArrayCollection $permissions): void;
}
