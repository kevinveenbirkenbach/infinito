<?php

namespace Infinito\Domain\Layer;

use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Entity\Meta\Law;
use Infinito\Entity\Meta\Relation\Member\MemberRelation;
use Infinito\Entity\Meta\Relation\Parent\CreatorRelation;
use Infinito\Entity\Meta\Relation\Parent\HeredityRelation;
use Infinito\Entity\Meta\Right;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Exception\Collection\NotSetElementException;

/**
 * @author kevinfrantz
 */
final class LayerClassMap implements LayerClassMapInterface
{
    /**
     * @var array|string[]
     */
    const LAYER_CLASS_MAP = [
        LayerType::SOURCE => AbstractSource::class,
        LayerType::LAW => Law::class,
        LayerType::RIGHT => Right::class,
        LayerType::HEREDITY => HeredityRelation::class,
        LayerType::MEMBER => MemberRelation::class,
        LayerType::CREATOR => CreatorRelation::class,
    ];

    /**
     * @throws NotSetElementException
     */
    public static function getClass(string $layer): string
    {
        if (array_key_exists($layer, self::LAYER_CLASS_MAP)) {
            return self::LAYER_CLASS_MAP[$layer];
        }
        throw new NotSetElementException('The requested layer is not mapped!');
    }
}
