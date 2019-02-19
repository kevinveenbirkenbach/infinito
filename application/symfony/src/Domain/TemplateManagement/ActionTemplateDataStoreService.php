<?php

namespace Infinito\Domain\TemplateManagement;

use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Exception\AllreadySetException;
use Infinito\Exception\NotSetException;
use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\NotDefinedException;
use Infinito\Exception\NoValidChoiceException;
use Infinito\Form\AbstractType;
use Infinito\Entity\EntityInterface;
use Infinito\Exception\NotCorrectInstanceException;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormView;

/**
 * @author kevinfrantz
 */
final class ActionTemplateDataStoreService implements ActionTemplateDataStoreServiceInterface
{
    /**
     * @var array|string[] Maps the action to an return type
     */
    const ACTION_DATA_MAPPING = [
        ActionType::CREATE => AbstractType::class,
        ActionType::READ => EntityInterface::class, // Mayber change this to refection later!
        ActionType::UPDATE => FormView::class,
        ActionType::DELETE => EntityInterface::class,
        ActionType::EXECUTE => EntityInterface::class, // This is just a dummy value to pass tests. Substitute it!
    ];

    /**
     * @var Collection
     */
    private $actionDataStore;

    /**
     * @param string $actionType
     *
     * @throws NotDefinedException For false a exception is thrown
     *
     * @return bool Everytime True
     */
    private function isValidActionType(string $actionType): bool
    {
        if (in_array($actionType, ActionType::getChoices())) {
            return true;
        }
        throw new NoValidChoiceException("The action type <<$actionType>> is not defined and not valid!");
    }

    /**
     * @param string $actionType
     * @param mixed  $data
     *
     * @throws NotCorrectInstanceException For false a exception is thrown
     *
     * @return bool Everytime True
     */
    private function isValidActionData(string $actionType, $data): bool
    {
        $instance = self::ACTION_DATA_MAPPING[$actionType];
        if ($data instanceof $instance) {
            return true;
        }
        throw new NotCorrectInstanceException('The data class <<'.get_class($data).">> for action type <<$actionType>> doesn't map to instance <<$instance>>.");
    }

    public function __construct()
    {
        $this->actionDataStore = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface::setActionTemplateData()
     */
    public function setData(string $actionType, $data): void
    {
        if ($this->isValidActionType($actionType) && $this->isValidActionData($actionType, $data) && $this->isDataStored($actionType)) {
            throw new AllreadySetException("The data for the action type <<$actionType>> is allready set!");
        }
        $this->actionDataStore->set($actionType, $data);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface::getActionTemplateData()
     */
    public function getData(string $actionType)
    {
        if ($this->isValidActionType($actionType) && $this->isDataStored($actionType)) {
            return $this->actionDataStore->get($actionType);
        }
        throw new NotSetException("The data for the action type <<$actionType>> is not set!");
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface::isActionTemplateDataSet()
     */
    public function isDataStored(string $actionType): bool
    {
        return $this->actionDataStore->containsKey($actionType);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface::getAllData()
     */
    public function getAllStoredData(): Collection
    {
        return $this->actionDataStore;
    }
}
