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
     *
     * @param string $actionType
     */
    public function setActionType(string $actionType): void;

    /**
     * @see ActionType
     *
     * @return string
     */
    public function getActionType(): string;
}
