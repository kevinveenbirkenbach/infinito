<?php

namespace App\Attribut;

use App\Domain\RequestManagement\Entity\RequestedEntityInterface;

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
