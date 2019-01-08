<?php

namespace App\Domain\SecureCRUDManagement\Factory;

use App\Domain\SecureCRUDManagement\CRUD\SecureCRUDInterface;
use App\Entity\Meta\RightInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author kevinfrantz
 *
 * @todo Improve code performance
 */
final class SecureCRUDFactoryService implements SecureCRUDFactoryServiceInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Security
     */
    private $security;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

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
        return 'App\\Domain\\SecureCRUDManagement\\CRUD\\'.$this->getCrud($crud).'\\'.$this->getClassName($layer, $crud);
    }

    public function __construct(RequestStack $requestStack, Security $security, EntityManagerInterface $entityManager)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryServiceInterface::create()
     */
    public function create(RightInterface $requestedRight): SecureCRUDInterface
    {
        $namespace = $this->getCRUDNamespace($requestedRight->getLayer(), $requestedRight->getType());

        return new $namespace($this->request, $this->security, $this->entityManager);
    }
}
