<?php

namespace Infinito\Attribut;

use Infinito\Domain\Request\Entity\RequestedEntityInterface;

/**
 * @author kevinfrantz
 *
 * @see RequestedEntityAttributInterface
 */
trait RequestedEntityAttribut
{
    /**
     * @var RequestedEntityInterface
     */
    private $requestedEntity;

    public function getRequestedEntity(): RequestedEntityInterface
    {
        return $this->requestedEntity;
    }

    public function setRequestedEntity(RequestedEntityInterface $requestedEntity): void
    {
        $this->requestedEntity = $requestedEntity;
    }

    public function hasRequestedEntity(): bool
    {
        return isset($this->requestedEntity);
    }
}
