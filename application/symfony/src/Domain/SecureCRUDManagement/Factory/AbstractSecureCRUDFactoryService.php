<?php

namespace App\Domain\SecureCRUDManagement\Factory;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author kevinfrantz
 *
 * @todo Implement!
 * @todo substitute through child classes!
 */
abstract class AbstractSecureCRUDFactoryService implements SecureCRUDFactoryServiceInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Security
     */
    protected $security;

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
    protected function getClassName(string $layer, string $crud): string
    {
        return 'Secure'.ucfirst(strtolower($layer)).$this->getCrud($crud);
    }

    /**
     * @param string $layer
     *
     * @return string
     */
    protected function getCRUDNamespace(string $layer, string $crud): string
    {
        return 'App\\Domain\\SecureCRUDManagement\\CRUD\\'.$this->getCrud($crud).'\\'.$this->getClassName($layer, $crud);
    }

    public function __construct(RequestStack $requestStack, Security $security)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->security = $security;
    }
}
