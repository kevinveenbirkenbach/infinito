<?php

namespace App\Domain\SecureCRUDManagement\Factory;

use App\Entity\Meta\RightInterface;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Domain\SecureCRUDManagement\CRUD\Create\SecureCreatorInterface;
use App\Domain\SecureCRUDManagement\CRUD\Create\SecureSourceCreator;

/**
 * @author kevinfrantz
 *
 * @todo Implement!
 */
final class SecureCreatorFactoryService extends AbstractSecureCRUDFactoryService
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryServiceInterface::create()
     */
    public function create(RightInterface $requestedRight): SecureCreatorInterface
    {
        switch ($requestedRight->getLayer()) {
            case LayerType::SOURCE:
                return new SecureSourceCreator($this->request, $this->security);
            case LayerType::MEMBER:
        }
    }
}
