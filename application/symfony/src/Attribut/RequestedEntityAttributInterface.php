<?php

namespace Infinito\Attribut;

use Infinito\Domain\Request\Entity\RequestedEntityInterface;

/**
 * @author kevinfrantz
 */
interface RequestedEntityAttributInterface
{
    public function hasRequestedEntity(): bool;

    public function getRequestedEntity(): RequestedEntityInterface;

    public function setRequestedEntity(RequestedEntityInterface $requestedEntity): void;
}
