<?php

namespace App\Domain\RequestManagement\Entity;

use App\Entity\EntityInterface;
use App\Attribut\SlugAttributInterface;

/**
 * A requested entity containes the stumb attributes to load an entity.
 *
 * @author kevinfrantz
 */
interface RequestedEntityInterface extends EntityInterface, SlugAttributInterface
{
    /**
     * Sets the slug or the id.
     *
     * @param string|int $identity
     */
    public function setIdentity($identity): void;
}
