<?php

namespace Infinito\Domain\Source;

/**
 * Offers informations about the source classes.
 *
 * @author kevinfrantz
 */
interface SourceClassInformationServiceInterface
{
    /**
     * @return array|string[] Returns all source classes
     */
    public function getAllSourceClasses(): array;

    /**
     * @param string $subNamespace The subpath of the classes
     *
     * @return array|string[] Returns all source classes of a subfolder
     */
    public function getAllSubSourceClasses(string $subNamespace): array;
}
