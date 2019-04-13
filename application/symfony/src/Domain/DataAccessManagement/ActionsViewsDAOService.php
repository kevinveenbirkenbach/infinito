<?php

namespace Infinito\Domain\DataAccessManagement;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @param ActionsResultsDAOServiceInterface $actionsResultsDAO
     */
    public function __construct(ActionsResultsDAOServiceInterface $actionsResultsDAO)
    {
        $this->actionsResultsDAO = $actionsResultsDAO;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccessManagement\ActionsDAOInterface::isDataStored()
     */
    public function isDataStored(string $actionType): bool
    {
        return $this->actionsResultsDAO->isDataStored($actionType);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccessManagement\ActionsDAOInterface::getAllStoredData()
     */
    public function getAllStoredData(): Collection
    {
        $storedData = new ArrayCollection();
        $allProccessedDataKeys = $this->actionsResultsDAO->getAllStoredData()->getKeys();
        foreach ($allProccessedDataKeys as $key) {
            $viewData = $this->getData($key);
            $storedData->set($key, $viewData);
        }
    }

    public function getData(string $actionType)
    {
    }
}
