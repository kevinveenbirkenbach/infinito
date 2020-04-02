<?php

namespace Infinito\Domain\Layer;

use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * @author kevinfrantz
 *
 * @todo for performance reasons it could be helpfull to implement lazy loading in the future
 */
final class LayerInterfaceMap implements LayerInterfaceMapInterface
{
    /**
     * @var string The abstract class prefix, which will be removed from the interface name
     */
    const ABSTRACT_CLASS_PREFIX = 'Abstract';

    /**
     * @var string The suffix which will be added to the interface name
     */
    const INTERFACE_SUFFIX = 'Interface';

    private static function filterAbstractClassName(string $shortClass): string
    {
        if (self::ABSTRACT_CLASS_PREFIX === substr($shortClass, 0, strlen(self::ABSTRACT_CLASS_PREFIX))) {
            return substr($shortClass, strlen(self::ABSTRACT_CLASS_PREFIX));
        }

        return $shortClass;
    }

    private static function addInterfaceSuffix(string $class): string
    {
        return $class.self::INTERFACE_SUFFIX;
    }

    public static function getInterface(string $layer): string
    {
        $className = LayerClassMap::getClass($layer);
        $elements = explode('\\', $className);
        $shortClass = $elements[count($elements) - 1];
        $filteredAbstractClass = self::filterAbstractClassName($shortClass);
        $elements[count($elements) - 1] = self::addInterfaceSuffix($filteredAbstractClass);
        $interfaceName = implode('\\', $elements);

        return $interfaceName;
    }

    public static function getAllInterfaces(): array
    {
        $allInterfaces = [];
        foreach (LayerType::getValues() as $layer) {
            $allInterfaces[$layer] = self::getInterface($layer);
        }

        return $allInterfaces;
    }
}
