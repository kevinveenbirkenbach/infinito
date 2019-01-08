<?php

namespace App\Domain\SecureCRUDManagement\CRUD\Create;

use App\Entity\EntityInterface;
use App\Domain\SecureCRUDManagement\CRUD\SecureCRUDServiceInterface;

/**
 * @todo Implement!
 *
 * @author kevinfrantz
 */
interface SecureCreateServiceInterface extends SecureCRUDServiceInterface
{
    /**
     * @return EntityInterface The created entity
     */
    public function create(): EntityInterface;
}
