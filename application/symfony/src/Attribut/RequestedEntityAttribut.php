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

    /**
     * @return RequestedEntityInterface
     */
    public function getRequestedEntity(): RequestedEntityInterface
    {
        return $this->requestedEntity;
    }

    /**
     * @param RequestedEntityInterface $requestedEntity
     */
    public function setRequestedEntity(RequestedEntityInterface $requestedEntity): void
    {
        $this->requestedEntity = $requestedEntity;
    }

    /**
     * @return bool
     */
    public function hasRequestedEntity(): bool
    {
        return isset($this->requestedEntity);
    }
}
