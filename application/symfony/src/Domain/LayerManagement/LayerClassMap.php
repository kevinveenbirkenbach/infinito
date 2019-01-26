<?php

namespace App\Domain\LayerManagement;

use App\DBAL\Types\Meta\Right\LayerType;
use App\Entity\Source\AbstractSource;
use App\Exception\NotSetException;

/**
 * @author kevinfrantz
 */
final class LayerClassMap implements LayerClassMapInterface
{
    const LAYER_CLASS_MAP = [
        LayerType::SOURCE => AbstractSource::class,
    ];

    /**
     * @param string $layer
     *
     * @throws NotSetException
     *
     * @return string
     */
    public static function getClass(string $layer): string
    {
        if (array_key_exists($layer, self::LAYER_CLASS_MAP)) {
            return self::LAYER_CLASS_MAP[$layer];
        }
        throw new NotSetException('The requested layer is not mapped!');
    }
}
