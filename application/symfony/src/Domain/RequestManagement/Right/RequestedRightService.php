<?php

namespace Infinito\Domain\RequestManagement\Right;

use Infinito\Domain\RequestManagement\Entity\RequestedEntityServiceInterface;

/**
 * Allows to use a right as a Service.
 *
 * @author kevinfrantz
 */
final class RequestedRightService extends RequestedRight implements RequestedRightServiceInterface
{
    /**
     * @param RequestedEntityServiceInterface $requestedEntityService
     */
    public function __construct(RequestedEntityServiceInterface $requestedEntityService)
    {
        parent::__construct($requestedEntityService);
    }
}
