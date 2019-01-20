<?php

namespace App\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use App\Domain\RequestManagement\RequestedUser;
use App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryService;
use App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryServiceInterface;

/**
 * @author kevinfrantz
 */
class AbstractViewBuilder implements ViewBuilderInterface
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
     * @param RequestedUser            $requestedUserRight
     * @param SecureCRUDFactoryService $secureCrudFactoryService
     */
    public function __construct(RequestedUser $requestedUserRight, SecureCRUDFactoryService $secureCrudFactoryService)
    {
        $this->view = new View();
        $this->requestedUserRight = $requestedUserRight;
        $this->secureCrudFactoryService = $secureCrudFactoryService;
    }

    /**
     * @return View
     */
    public function getView(): View
    {
        $this->secureCrudFactoryService->create($requestedRight);
    }
}
