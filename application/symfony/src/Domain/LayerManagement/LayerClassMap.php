<?php

namespace Infinito\Domain\LayerManagement;

use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Exception\NotSetException;
use Infinito\Entity\Meta\Law;
use Infinito\Entity\Meta\Right;

/**
 * @author kevinfrantz
 */
final class LayerClassMap implements LayerClassMapInterface
{
    const LAYER_CLASS_MAP = [
        LayerType::SOURCE => AbstractSource::class,
        LayerType::LAW => Law::class,
        LayerType::RIGHT => Right::class,
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
