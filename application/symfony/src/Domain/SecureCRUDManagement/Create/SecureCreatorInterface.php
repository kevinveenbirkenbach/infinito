<?php

namespace App\Domain\SecureCRUDManagement\Create;

use App\Domain\SecureCRUDManagement\SecureCRUDInterface;
use App\Entity\EntityInterface;

/**
 * @todo Implement!
 * @author kevinfrantz
 *
 */
interface SecureCreatorInterface extends SecureCRUDInterface
{
    /**
     * @return EntityInterface The created entity
     */
    public function create(): EntityInterface;
}
