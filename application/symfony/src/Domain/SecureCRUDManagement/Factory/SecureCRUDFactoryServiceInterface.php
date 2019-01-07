<?php

namespace App\Domain\SecureCRUDManagement\Factory;

use App\Entity\Meta\RightInterface;
use App\Domain\SecureCRUDManagement\CRUD\Create\SecureCreatorInterface;

/**
 * @author kevinfrantz
 */
interface SecureCRUDFactoryServiceInterface
{
    /**
     * @return SecureCreatorInterface
     */
    public function create(RightInterface $requestedRight): SecureCreatorInterface;
}
