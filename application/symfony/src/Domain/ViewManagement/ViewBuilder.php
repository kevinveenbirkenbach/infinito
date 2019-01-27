<?php

namespace App\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryService;
use App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryServiceInterface;
use App\Domain\RequestManagement\User\RequestedUserInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;

/**
 * @author kevinfrantz
 */
class ViewBuilder implements ViewBuilderInterface
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var SecureCRUDFactoryServiceInterface
     */
    protected $secureCrudFactoryService;

    /**
     * @var RequestedEntityInterface
     */
    protected $requestedEntity;

    /**
     * @var RequestedUserInterface
     */
    protected $requestedUser;

    /**
     * @param RequestedUserInterface   $requestedUserRight
     * @param SecureCRUDFactoryService $secureCrudFactoryService
     */
    public function __construct(RequestedUserInterface $requestedUserRight, SecureCRUDFactoryService $secureCrudFactoryService, RequestedEntityInterface $requestedEntity)
    {
        $this->view = new View();
        $this->requestedUser = $requestedUserRight;
        $this->secureCrudFactoryService = $secureCrudFactoryService;
        $this->requestedEntity = $requestedEntity;
    }

    private function process()
    {
        $secureCrudService = $this->secureCrudFactoryService->create($this->requestedUser);
        $entity = $secureCrudService->process($this->requestedEntity);
    }

    /**
     * @return View
     */
    public function getView(): View
    {
    }
}
