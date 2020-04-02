<?php

namespace Infinito\Domain\Request\Entity;

use Infinito\Attribut\ClassAttributInterface;
use Infinito\Attribut\RequestedRightAttributInterface;
use Infinito\Attribut\SlugAttributInterface;
use Infinito\Entity\EntityInterface;

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

    public function getEntity(): EntityInterface;
}
