<?php

namespace Infinito\Attribut;

use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\Type\InvalidChoiceTypeException;

/**
 * @author kevinfrantz
 */
trait ActionTypeAttribut
{
    /**
     * @see ActionType
     *
     * @var string
     */
    protected $actionType;

    /**
     * @throws InvalidChoiceTypeException
     */
    public function setActionType(string $actionType): void
    {
        if (!in_array($actionType, ActionType::getValues())) {
            throw new InvalidChoiceTypeException('The type is not a valid action type.');
        }
        $this->actionType = $actionType;
    }

    public function getActionType(): string
    {
        return $this->actionType;
    }
}
