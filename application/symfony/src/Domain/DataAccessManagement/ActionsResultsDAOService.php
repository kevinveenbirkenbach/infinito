<?php

namespace Infinito\Domain\DataAccessManagement;

use Doctrine\Common\Collections\Collection;
use Infinito\Exception\AllreadySetException;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Exception\NotSetException;
use Infinito\Exception\NoValidChoiceException;
use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\NotCorrectInstanceException;
use Infinito\Entity\EntityInterface;
use Infinito\Logic\Result\ResultInterface;

/**
 * @author kevinfrantz
 */
final class ActionsResultsDAOService extends AbstractActionsDAO implements ActionsResultsDAOServiceInterface
{
    /**
     * @var Collection|mixed[]
     */
    private $processedData;

    /**
     * @param string $actionType
     *
     * @throws NoValidChoiceException
     */
    private function throwNoValidActionTypeException(string $actionType): void
    {
        throw new NoValidChoiceException("The action type <<$actionType>> is not defined and not valid!");
    }

    /**
     * @param string $actionType
     *
     * @throws NoValidChoiceException For false a exception is thrown
     *
     * @return bool Everytime True
     */
    private function isValidActionType(string $actionType): bool
    {
        if (in_array($actionType, ActionType::getValues())) {
            return true;
        }
        $this->throwNoValidActionTypeException($actionType);
    }

    /**
     * This function describes which data is expected.
     *
     * @param string $actionType
     * @param mixed  $data
     *
     * @throws NotCorrectInstanceException For false a exception is thrown
     *
     * @return bool Everytime True
     */
    private function validateActionData(string $actionType, $data): bool
    {
        if ($this->isValidActionData($actionType)) {
            return true;
        }
        throw new NotCorrectInstanceException('Data <<'.($data).">> for action type <<$actionType>> is not valid!");
    }

    /**
     * @param string                               $actionType
     * @param EntityInterface|ResultInterface|null $data
     *
     * @return bool True if the data is valid
     * @return bool
     */
    private function isValidActionData(string $actionType, $data): bool
    {
        switch ($actionType) {
            case ActionType::READ:
            case ActionType::CREATE:
            case ActionType::UPDATE:
                return $data instanceof EntityInterface;
            case ActionType::DELETE:
                return null === $data;
            case ActionType::EXECUTE:
                return $data instanceof ResultInterface;
        }
        $this->throwNoValidActionTypeException($actionType);
    }

    public function __construct()
    {
        $this->processedData = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccessManagement\ActionsDAOInterface::getAllStoredData()
     */
    public function getAllStoredData(): Collection
    {
        return $this->processedData;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccessManagement\ActionsResultsDAOServiceInterface::setData()
     */
    public function setData(string $actionType, $data): void
    {
        if ($this->isValidActionType($actionType) && $this->validateActionData($actionType, $data) && $this->isDataStored($actionType)) {
            throw new AllreadySetException("The data for the action type <<$actionType>> is allready set!");
        }
        $this->processedData->set($actionType, $data);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccessManagement\ActionsDAOInterface::isDataStored()
     */
    public function isDataStored(string $actionType): bool
    {
        return $this->processedData->containsKey($actionType);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DataAccessManagement\ActionsDAOInterface::getData()
     */
    public function getData(string $actionType)
    {
        if ($this->isValidActionType($actionType) && $this->isDataStored($actionType)) {
            return $this->processedData->get($actionType);
        }
        throw new NotSetException("The data for the action type <<$actionType>> is not set!");
    }
}
