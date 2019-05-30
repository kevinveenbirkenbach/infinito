<?php

namespace Infinito\Attribut;

use Infinito\Domain\Request\Entity\RequestedEntityInterface;

/**
 * @author kevinfrantz
 */
interface RequestedEntityAttributInterface
{
    /**
     * @return bool
     */
    public function hasRequestedEntity(): bool;

    /**
     * @return RequestedEntityInterface
     */
    public function getRequestedEntity(): RequestedEntityInterface;

    /**
     * @param RequestedEntityInterface $requestedEntity
     */
    public function setRequestedEntity(RequestedEntityInterface $requestedEntity): void;
}
