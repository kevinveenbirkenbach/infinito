<?php

namespace Infinito\Attribut;

use Infinito\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 *
 * @see ActionType
 */
interface ActionTypeAttributInterface
{
    /**
     * @see ActionType
     */
    public function setActionType(string $actionType): void;

    /**
     * @see ActionType
     */
    public function getActionType(): string;
}
