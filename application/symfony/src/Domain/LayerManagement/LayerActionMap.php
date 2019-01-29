<?php

namespace App\Domain\LayerManagement;

use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\ActionType;
use App\Domain\MapManagement\AbstractMap;

/**
 * @author kevinfrantz
 */
final class LayerActionMap extends AbstractMap implements LayerActionMapInterface
{
    /**
     * @var array Add new combination possibilities to this map!
     */
    const LAYER_ACTION_MAP = [
        LayerType::SOURCE => [
            ActionType::READ,
            ActionType::CREATE,
            ActionType::UPDATE,
            ActionType::DELETE,
            ActionType::THREAD,
        ],
    ];

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\LayerManagement\LayerActionMapInterface::getLayers()
     */
    public static function getLayers(string $action): array
    {
        return parent::getIndizesByValue($action, self::LAYER_ACTION_MAP);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\LayerManagement\LayerActionMapInterface::getActions()
     */
    public static function getActions(string $layer): array
    {
        return parent::getValuesByIndex($layer, self::LAYER_ACTION_MAP);
    }
}
