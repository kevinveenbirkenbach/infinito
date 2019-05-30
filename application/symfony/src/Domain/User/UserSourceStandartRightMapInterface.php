<?php

namespace Infinito\Domain\User;

use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\ActionType;

/**
 * Containes the standart map.
 *
 * @author kevinfrantz
 */
interface UserSourceStandartRightMapInterface
{
    const LAYER_RIGHT_MAP = [
        LayerType::SOURCE => [
            ActionType::READ,
            ActionType::UPDATE,
        ],
    ];
}
