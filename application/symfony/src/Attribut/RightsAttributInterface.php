<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
interface RightsAttributInterface
{
    const RIGHTS_ATTRIBUT_NAME = 'rights';

    /**
     * @param Collection|RightInterface[] $rights
     */
    public function setRights(Collection $rights): void;

    /**
     * @return Collection|RightInterface[]
     */
    public function getRights(): Collection;
}
