<?php

namespace App\Domain\SecureCRUDManagement\Factory;

use App\Entity\Meta\RightInterface;
use App\Domain\SecureCRUDManagement\AbstractSecureCRUDService;
use App\Domain\SecureCRUDManagement\CRUD\SecureCRUDServiceInterface;

/**
 * @author kevinfrantz
 *
 * @todo Improve code performance
 */
final class SecureCRUDFactoryService extends AbstractSecureCRUDService implements SecureCRUDFactoryServiceInterface
{
    /**
     * @param string $crud
     *
     * @return string
     */
    private function getCrud(string $crud): string
    {
        return ucfirst(strtolower($crud));
    }

    /**
     * @param string $layer
     * @param string $crud
     *
     * @return string
     */
    private function getClassName(string $layer, string $crud): string
    {
        return 'Secure'.ucfirst(strtolower($layer)).$this->getCrud($crud);
    }

    /**
     * @param string $layer
     *
     * @return string
     */
    private function getCRUDNamespace(string $layer, string $crud): string
    {
        return 'App\\Domain\\SecureCRUDManagement\\CRUD\\'.$this->getCrud($crud).'\\'.$this->getClassName($layer, $crud).'Service';
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryServiceInterface::create()
     */
    public function create(RightInterface $requestedRight): SecureCRUDServiceInterface
    {
        $namespace = $this->getCRUDNamespace($requestedRight->getLayer(), $requestedRight->getCrud());

        return new $namespace($this->requestStack, $this->security, $this->entityManager);
    }
}
