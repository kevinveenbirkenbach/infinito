<?php

namespace App\Domain\SecureCRUDManagement;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author kevinfrantz
 */
abstract class AbstractSecureCRUDService
{
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var Security
     */
    protected $security;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param RequestStack           $requestStack
     * @param Security               $security
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(RequestStack $requestStack, Security $security, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->security = $security;
        $this->entityManager = $entityManager;
    }
}
