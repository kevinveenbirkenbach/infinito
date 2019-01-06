<?php

namespace App\Domain\PathManagement;

/**
 * @author kevinfrantz
 */
final class NamespacePathMap implements NamespacePathMapInterface
{
    /**
     * @var array|string[]
     */
    private $folders;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\PathManagement\NamespacePathMapInterface::getNamespace()
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\PathManagement\NamespacePathMapInterface::getPath()
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\PathManagement\NamespacePathMapInterface::setPath()
     */
    public function setPath(string $path): void
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\PathManagement\NamespacePathMapInterface::setNamespace()
     */
    public function setNamespace(string $namespace): void
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\PathManagement\NamespacePathMapInterface::setFolderArray()
     */
    public function setFolderArray(array $folders): void
    {
    }

    public function getFolderArray(): array
    {
    }
}
