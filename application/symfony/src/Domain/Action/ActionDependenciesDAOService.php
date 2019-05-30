<?php

namespace Infinito\Domain\Action;

use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Infinito\Repository\RepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Infinito\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;

/**
 * @author kevinfrantz
 */
final class ActionDependenciesDAOService implements ActionDependenciesDAOServiceInterface
{
    /**
     * @var RequestStack
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
     * @see \Infinito\Domain\Action\ActionDependenciesDAOServiceInterface::getRequestedAction()
     */
    public function getRequestedAction(): RequestedActionInterface
    {
        return $this->requestedAction;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\ActionDependenciesDAOServiceInterface::isRequestedActionSecure()
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
     * @see \Infinito\Domain\Action\ActionDependenciesDAOServiceInterface::getRequest()
     */
    public function getRequest(): Request
    {
        return $this->requestStack->getCurrentRequest();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\ActionDependenciesDAOServiceInterface::getRepository()
     */
    public function getRepository(): RepositoryInterface
    {
        $layer = $this->requestedAction->getLayer();

        return $this->layerRepositoryFactoryService->getRepository($layer);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\ActionDependenciesDAOServiceInterface::getEntityManager()
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}
