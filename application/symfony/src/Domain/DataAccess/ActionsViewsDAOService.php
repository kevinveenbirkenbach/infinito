<?php

namespace Infinito\Domain\DataAccess;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Form\RequestedActionFormBuilderServiceInterface;

/**
 * @author kevinfrantz
 */
final class ActionsViewsDAOService extends AbstractActionsDAO implements ActionsViewsDAOServiceInterface
{
    /**
     * @var ActionsResultsDAOServiceInterface
     */
    private $actionsResultsDAO;

    /**
     * @var RequestedActionFormBuilderServiceInterface
     */
    private $requestedActionFormBuilderService;

    public function __construct(ActionsResultsDAOServiceInterface $actionsResultsDAO, RequestedActionFormBuilderServiceInterface $requestedActionFormBuilderService)
    {
        $this->actionsResultsDAO = $actionsResultsDAO;
        $this->requestedActionFormBuilderService = $requestedActionFormBuilderService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccess\ActionsDAOInterface::isDataStored()
     */
    public function isDataStored(string $actionType): bool
    {
        return $this->actionsResultsDAO->isDataStored($actionType);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccess\ActionsDAOInterface::getAllStoredData()
     */
    public function getAllStoredData(): Collection
    {
        $storedData = new ArrayCollection();
        $allProccessedDataKeys = $this->actionsResultsDAO->getAllStoredData()->getKeys();
        foreach ($allProccessedDataKeys as $key) {
            $viewData = $this->getData($key);
            $storedData->set($key, $viewData);
        }

        return $storedData;
    }

    private function getCreateForm()
    {
        return $this->requestedActionFormBuilderService->createByService()
        ->getForm()
        ->createView();
    }

    /**
     * @todo Implement the mapping
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccess\ActionsDAOInterface::getData()
     */
    public function getData(string $actionType)
    {
        switch ($actionType) {
            case ActionType::CREATE:
                return $this->getCreateForm();
        }

        return $this->actionsResultsDAO->getData($actionType);
    }
}
