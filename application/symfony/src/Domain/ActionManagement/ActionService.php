<?php

namespace App\Domain\ActionManagement;

use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerInterface;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\RepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;

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
     * @var SecureRequestedRightCheckerInterface
     */
    private $secureRequestedRightChecker;

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
     * @param RequestedActionInterface $requestedAction
     */
    public function __construct(RequestedActionInterface $requestedAction, SecureRequestedRightCheckerInterface $secureRequestedRightChecker, RequestStack $requestStack, LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService, RequestedActionFormBuilderServiceInterface $requestedActionFormBuilderService, EntityManagerInterface $entityManager)
    {
        $this->requestedAction = $requestedAction;
        $this->secureRequestedRightChecker = $secureRequestedRightChecker;
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
        return $this->secureRequestedRightChecker->check($this->requestedAction);
    }

    /**
     * @return FormBuilderInterface
     */
    public function getForm(): FormBuilderInterface
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
