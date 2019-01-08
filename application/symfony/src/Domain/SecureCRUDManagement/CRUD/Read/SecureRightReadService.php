<?php

namespace App\Domain\SecureCRUDManagement\CRUD\Read;

use App\Entity\EntityInterface;
use App\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
final class SecureRightReadService extends AbstractSecureReadService
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureCRUDManagement\CRUD\Read\SecureReadServiceInterface::read()
     */
    public function read(RightInterface $requestedRight): EntityInterface
    {
    }
}
