<?php

namespace App\Domain\RequestManagement\Entity;

use App\Entity\EntityInterface;
use App\Attribut\SlugAttributInterface;
use App\Attribut\RequestedRightAttributInterface;
use App\Attribut\ClassAttributInterface;

/**
 * A requested entity containes the stumb attributes to load an entity.
 *
 * @author kevinfrantz
 */
interface RequestedEntityInterface extends EntityInterface, SlugAttributInterface, RequestedRightAttributInterface, ClassAttributInterface
{
    /**
     * Sets the slug or the id.
     *
     * @param string|int $identity
     */
    public function setIdentity($identity): void;

    /**
     * @return bool True if an identity attribut is defined
     */
    public function hasIdentity(): bool;

    /**
     * @return EntityInterface
     */
    public function getEntity(): EntityInterface;
}
