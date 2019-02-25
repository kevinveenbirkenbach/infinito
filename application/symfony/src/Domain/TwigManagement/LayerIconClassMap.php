<?php

namespace Infinito\Domain\TwigManagement;

use Infinito\Exception\NotSetException;
use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * @author kevinfrantz
 */
final class LayerIconClassMap implements LayerIconClassMapInterface
{
    /**
     * @var array|string[]
     */
    const LAYER_ICON_CLASS_MAP = [
        LayerType::SOURCE => 'fas fa-tint',
        LayerType::LAW => 'fas fa-gavel',
        LayerType::RIGHT => 'fas fa-check',
        LayerType::HEREDITY => 'fas fa-seedling',
        LayerType::MEMBER => 'fas fa-users',
        LayerType::CREATOR => 'fas fa-bed',
    ];

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TwigManagement\LayerIconClassMapInterface::getIconClass()
     */
    public function getIconClass(string $layer): string
    {
        if (key_exists($layer, self::LAYER_ICON_CLASS_MAP)) {
            return self::LAYER_ICON_CLASS_MAP[$layer];
        }
        throw new NotSetException("The key <<$layer>> is not defined in the map!");
    }
}
