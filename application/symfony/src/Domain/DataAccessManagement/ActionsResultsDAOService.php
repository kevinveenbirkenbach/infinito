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
use Symfony\Component\Intl\Exception\NotImplementedException;

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
     * @param string                               $actionType
     * @param EntityInterface|ResultInterface|null $data
     *
     * @return bool True if the data is valid
     * @return bool
     */
    private function isValidActionData(string $actionType, $data): bool
    {
        switch ($actionType) {
            case ActionType::CREATE:
                return $data instanceof EntityInterface | null === $data;
            case ActionType::READ:
            case ActionType::UPDATE:
                return $data instanceof EntityInterface;
            case ActionType::DELETE:
                return null === $data;
            case ActionType::EXECUTE:
                return $data instanceof ResultInterface;
        }
        throw new NotImplementedException("The ActionType <<$actionType>> is not implemented in <<".__CLASS__.':'.__FUNCTION__.'>>');
    }

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
     * @return bool
     */
    private function isValidActionType(string $actionType): bool
    {
        return in_array($actionType, ActionType::getValues());
    }

    /**
     * @param string $actionType
     */
    private function validateActionType(string $actionType): void
    {
        if (!$this->isValidActionType($actionType)) {
            $this->throwNoValidActionTypeException($actionType);
        }
    }

    /**
     * This function describes which data is expected.
     *
     * @param string $actionType
     * @param mixed  $data
     *
     * @throws NotCorrectInstanceException For false a exception is thrown
     */
    private function validateActionData(string $actionType, $data): void
    {
        if (!$this->isValidActionData($actionType, $data)) {
            throw new NotCorrectInstanceException('Data <<'.gettype($data).(is_object($data) ? ':'.get_class($data) : '').">> is not valid for action type <<$actionType>>!");
        }
    }

    /**
     * @param string $actionType
     *
     * @throws NotSetException
     */
    private function validateNotSet(string $actionType): void
    {
        if ($this->isDataStored($actionType)) {
            throw new AllreadySetException("Data for <<$actionType>> is allready stored.");
        }
    }

    /**
     * @param string $actionType
     *
     * @throws NotSetException
     */
    private function validateSet(string $actionType): void
    {
        if (!$this->isDataStored($actionType)) {
            throw new NotSetException("No data for <<$actionType>> is stored.");
        }
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
        $this->validateActionType($actionType);
        $this->validateActionData($actionType, $data);
        $this->validateNotSet($actionType);
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
        $this->validateActionType($actionType);
        $this->validateSet($actionType);

        return $this->processedData->get($actionType);
    }
}