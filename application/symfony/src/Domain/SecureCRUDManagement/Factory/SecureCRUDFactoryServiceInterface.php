<?php

namespace App\Domain\SecureCRUDManagement\Factory;

use App\Entity\Meta\RightInterface;
use App\Domain\SecureCRUDManagement\CRUD\SecureCRUDInterface;

/**
 * @author kevinfrantz
 */
interface SecureCRUDFactoryServiceInterface
{
    /**
     * @return SecureCRUDInterface
     */
    public function create(RightInterface $requestedRight): SecureCRUDInterface;
}
