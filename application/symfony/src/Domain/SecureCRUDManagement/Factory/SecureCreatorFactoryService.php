<?php

namespace App\Domain\SecureCRUDManagement\Factory;

use App\Entity\Meta\RightInterface;
use App\Domain\SecureCRUDManagement\CRUD\Create\SecureCreatorInterface;
use App\DBAL\Types\Meta\Right\CRUDType;

/**
 * @author kevinfrantz
 *
 * @todo Implement!
 */
final class SecureCreatorFactoryService extends AbstractSecureCRUDFactoryService
{
    const CRUD_TYPE = CRUDType::CREATE;

    /**
     * @param string $layer
     * @param string $crud
     *
     * @return string
     */
    protected function getClassName(string $layer, string $crud): string
    {
        return 'Secure'.ucfirst(strtolower($layer)).'Creator';
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryServiceInterface::create()
     */
    public function create(RightInterface $requestedRight): SecureCreatorInterface
    {
        $namespace = $this->getCRUDNamespace($requestedRight->getLayer(), self::CRUD_TYPE);

        return new $namespace($this->request, $this->security);
    }
}
