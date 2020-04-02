<?php

namespace Infinito\Domain\Path;

/**
 * Allows to map a path to an namespace.
 *
 * @author kevinfrantz
 */
interface NamespacePathMapInterface
{
    public function setNamespace(string $namespace): void;

    public function setPath(string $path): void;

    public function getNamespace(): string;

    public function getPath(): string;

    /**
     * @param array|string[] $folders
     */
    public function setFolders(array $folders): void;

    /**
     * @return array|string[]
     */
    public function getFolders(): array;
}
