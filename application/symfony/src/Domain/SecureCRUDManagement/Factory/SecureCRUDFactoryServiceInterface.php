<?php

namespace App\Domain\SecureCRUDManagement\Factory;

use App\Entity\Meta\RightInterface;
use App\Domain\SecureCRUDManagement\CRUD\SecureCRUDServiceInterface;

/**
 * @author kevinfrantz
 */
interface SecureCRUDFactoryServiceInterface
{
    /**
     * @return SecureCRUDServiceInterface
     */
    public function create(RightInterface $requestedRight): SecureCRUDServiceInterface;
}
