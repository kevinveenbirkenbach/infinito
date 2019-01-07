<?php

namespace App\Domain\SecureCRUDManagement\CRUD\Create;

use App\Entity\EntityInterface;
use App\Domain\SecureCRUDManagement\CRUD\SecureCRUDInterface;

/**
 * @todo Implement!
 *
 * @author kevinfrantz
 */
interface SecureCreatorInterface extends SecureCRUDInterface
{
    /**
     * @return EntityInterface The created entity
     */
    public function create(): EntityInterface;
}
