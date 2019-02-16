<?php

namespace App\Domain\ActionManagement;

use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\RepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;

/**
 * @author kevinfrantz
 */
final class ActionService implements ActionServiceInterface
{
    /**
     * @var Request
     */
    private $requestStack;

    /**
     * @var RequestedActionInterface
     */
    private $requestedAction;

    /**
     * @var SecureRequestedRightCheckerServiceInterface
     */
    private $secureRequestedRightCheckerService;

    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    private $layerRepositoryFactoryService;

    /**
     * @var RequestedActionFormBuilderServiceInterface
     */
    private $requestedActionFormBuilderService;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param RequestedActionInterface $requestedActionService
     */
    public function __construct(RequestedActionServiceInterface $requestedActionService, SecureRequestedRightCheckerServiceInterface $secureRequestedRightChecker, RequestStack $requestStack, LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService, RequestedActionFormBuilderServiceInterface $requestedActionFormBuilderService, EntityManagerInterface $entityManager)
    {
        $this->requestedAction = $requestedActionService;
        $this->secureRequestedRightCheckerService = $secureRequestedRightChecker;
        $this->requestStack = $requestStack;
        $this->layerRepositoryFactoryService = $layerRepositoryFactoryService;
        $this->requestedActionFormBuilderService = $requestedActionFormBuilderService;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\ActionServiceInterface::getRequestedAction()
     */
    public function getRequestedAction(): RequestedActionInterface
    {
        return $this->requestedAction;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\ActionServiceInterface::isRequestedActionSecure()
     */
    public function isRequestedActionSecure(): bool
    {
        return $this->secureRequestedRightCheckerService->check($this->requestedAction);
    }

    /**
     * @return FormBuilderInterface
     */
    public function getCurrentFormBuilder(): FormBuilderInterface
    {
        return $this->requestedActionFormBuilderService->createByService();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\ActionServiceInterface::getRequest()
     */
    public function getRequest(): Request
    {
        return $this->requestStack->getCurrentRequest();
    }

    /**
     * {@use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;inheritDoc}.
     *
     * @see \App\Domain\ActionManagement\ActionServiceInterface::getRepository()
     */
    public function getRepository(): RepositoryInterface
    {
        $layer = $this->requestedAction->getLayer();

        return $this->layerRepositoryFactoryService->getRepository($layer);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\ActionServiceInterface::getEntityManager()
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}
