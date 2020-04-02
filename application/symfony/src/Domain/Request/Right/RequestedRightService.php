<?php

namespace Infinito\Domain\Request\Right;

use Infinito\Domain\Request\Entity\RequestedEntityServiceInterface;

/**
 * Allows to use a right as a Service.
 *
 * @author kevinfrantz
 */
final class RequestedRightService extends RequestedRight implements RequestedRightServiceInterface
{
    public function __construct(RequestedEntityServiceInterface $requestedEntityService)
    {
        parent::__construct($requestedEntityService);
    }
}
