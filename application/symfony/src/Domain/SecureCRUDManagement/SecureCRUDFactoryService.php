<?php

namespace App\Domain\SecureCRUDManagement;

use App\Entity\Meta\RightInterface;
use App\Domain\SecureCRUDManagement\Create\SecureSourceCreator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * 
 * @author kevinfrantz
 * @todo Implement!
 * @todo substitute through child classes!
 */
class SecureCRUDFactoryService
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Security
     */
    private $security;

    public function __construct(RequestStack $requestStack, Security $security)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->security = $security;
    }

    /**
     * @param RightInterface $requestedRight
     */
    public function create(?RightInterface $requestedRight = null)
    {
        return new SecureSourceCreator($this->request, $this->security);
    }
}
