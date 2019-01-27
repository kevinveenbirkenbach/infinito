<?php

namespace App\Domain\LayerManagement;

use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
final class LayerActionMap implements LayerActionMapInterface
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
        $layers = [];
        foreach (self::LAYER_ACTION_MAP as $layer => $actions) {
            if (in_array($action, $actions)) {
                $layers[] = $layer;
            }
        }

        return $layers;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\LayerManagement\LayerActionMapInterface::getActions()
     */
    public static function getActions(string $layer): array
    {
        if (array_key_exists($layer, self::LAYER_ACTION_MAP)) {
            return self::LAYER_ACTION_MAP[$layer];
        }

        return [];
    }
}
