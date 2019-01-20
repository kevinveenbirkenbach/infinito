<?php

namespace App\Attribut;

use App\Exception\NoValidChoiceException;
use App\DBAL\Types\ActionType;

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
     * @param string $actionType
     */
    public function setActionType(string $actionType): void
    {
        if (!array_key_exists($actionType, ActionType::getChoices())) {
            throw new NoValidChoiceException('The type is not a valid action type.');
        }
        $this->actionType = $actionType;
    }

    /**
     * @return string
     */
    public function getActionType(): string
    {
        return $this->actionType;
    }
}
