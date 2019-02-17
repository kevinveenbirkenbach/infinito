<?php

namespace Infinito\Domain\PathManagement;

/**
 * @todo Be carefull with the case sensivity. Solve this!
 *
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
     * @see \Infinito\Domain\PathManagement\NamespacePathMapInterface::getNamespace()
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\PathManagement\NamespacePathMapInterface::getPath()
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\PathManagement\NamespacePathMapInterface::setPath()
     */
    public function setPath(string $path): void
    {
        $this->setFolders(explode('/', $path));
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\PathManagement\NamespacePathMapInterface::setNamespace()
     */
    public function setNamespace(string $namespace): void
    {
        $this->setFolders(explode('\\', $namespace));
    }

    /**
     * The strtolower function could lead to conflicts in other contextes
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\PathManagement\NamespacePathMapInterface::setFolderArray()
     */
    public function setFolders(array $folders): void
    {
        $this->folders = [];
        foreach ($folders as $folder) {
            $this->folders[] = strtolower($folder);
        }
        $this->namespace = implode('\\', $this->folders);
        $this->path = implode('/', $this->folders);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\PathManagement\NamespacePathMapInterface::getFolders()
     */
    public function getFolders(): array
    {
        return $this->folders;
    }
}
