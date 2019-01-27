<?php

namespace App\Domain\ActionManagement;

use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerInterface;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\FormManagement\EntityFormBuilderServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\RepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\EntityInterface;
use Doctrine\ORM\EntityManagerInterface;

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
     * @var
     */
    private $entityFormBuilderService;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param RequestedActionInterface $requestedAction
     */
    public function __construct(RequestedActionInterface $requestedAction, SecureRequestedRightCheckerInterface $secureRequestedRightChecker, RequestStack $requestStack, LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService, EntityFormBuilderServiceInterface $entityFormBuilderService, EntityManagerInterface $entityManager)
    {
        $this->requestedAction = $requestedAction;
        $this->secureRequestedRightChecker = $secureRequestedRightChecker;
        $this->requestStack = $requestStack;
        $this->layerRepositoryFactoryService = $layerRepositoryFactoryService;
        $this->entityFormBuilderService = $entityFormBuilderService;
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
    public function getForm(EntityInterface $entity): FormBuilderInterface
    {
        $this->entityFormBuilderService->create($entity);
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
