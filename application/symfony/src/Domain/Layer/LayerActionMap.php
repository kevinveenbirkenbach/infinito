<?php

namespace Infinito\Domain\Layer;

use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Map\AbstractMap;

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
            ActionType::EXECUTE,
        ],
    ];

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Layer\LayerActionMapInterface::getLayers()
     */
    public static function getLayers(string $action): array
    {
        return parent::getIndizesByValue($action, self::LAYER_ACTION_MAP);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Layer\LayerActionMapInterface::getActions()
     */
    public static function getActions(string $layer): array
    {
        return parent::getValuesByIndex($layer, self::LAYER_ACTION_MAP);
    }
}
