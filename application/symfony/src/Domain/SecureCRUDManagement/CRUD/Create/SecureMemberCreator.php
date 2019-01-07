<?php

namespace App\Domain\SecureCRUDManagement\CRUD\Create;

use App\Domain\SecureCRUDManagement\Create\AbstractSecureCreator;
use App\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
final class SecureMemberCreator extends AbstractSecureCreator
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureCRUDManagement\Create\SecureCreatorInterface::create()
     */
    public function create(): EntityInterface
    {
        //todo implement!
    }
}
