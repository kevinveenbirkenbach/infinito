<?php

namespace App\Domain\SecureCRUDManagement\CRUD\Read;

use App\Domain\SecureCRUDManagement\CRUD\SecureCRUDServiceInterface;
use App\Entity\EntityInterface;
use App\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
interface SecureReadServiceInterface extends SecureCRUDServiceInterface
{
    /**
     * @param RightInterface $requestedRight
     *
     * @return EntityInterface
     */
    public function read(RightInterface $requestedRight): EntityInterface;
}
