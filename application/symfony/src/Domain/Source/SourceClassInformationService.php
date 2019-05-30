<?php

namespace Infinito\Domain\Source;

/**
 * @author kevinfrantz
 */
final class SourceClassInformationService implements SourceClassInformationServiceInterface
{
    /**
     * @var string Folder with the source entities
     */
    const FOLDER = __DIR__.'/../../Entity/Source';

    /**
     * @var string Namespace praefix for sources
     */
    const SOURCE_CLASS_NAMESPACE = 'Infinito\\Entity\\Source';

    /**
     * @var string Suffix to identifie php files
     */
    const PHP_SUFFIX = '.php';

    /**
     * @var string Suffix to identify interfaces
     */
    const INTERFACE_SUFFIX = 'Interface'.self::PHP_SUFFIX;

    /**
     * @var string[]|array Containes all source classes
     */
    private $allClasses = [];

    /**
     * @param string $path
     *
     * @return bool
     */
    private function isPHP(string $path): bool
    {
        return self::PHP_SUFFIX === substr($path, -strlen(self::PHP_SUFFIX));
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    private function isInterface(string $path): bool
    {
        return self::INTERFACE_SUFFIX === substr($path, -strlen(self::INTERFACE_SUFFIX));
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function transformPathToClass(string $path): string
    {
        $withoutSuffix = str_replace(self::PHP_SUFFIX, '', $path);
        $withoutFolder = str_replace(self::FOLDER, '', $withoutSuffix);
        $class = str_replace('/', '\\', $withoutFolder);
        $fullclass = self::SOURCE_CLASS_NAMESPACE.$class;

        return $fullclass;
    }

    /**
     * @param string $path
     */
    private function addToClasses(string $path): void
    {
        $this->allClasses[] = $this->transformPathToClass($path);
    }

    private function loadClasses(): void
    {
        $recursiveDirectoryIterator = new \RecursiveDirectoryIterator(self::FOLDER);
        $files = new \RecursiveIteratorIterator($recursiveDirectoryIterator, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($files as $file) {
            $path = $file->getPathname();
            if ($this->isPHP($path) && !$this->isInterface($path)) {
                $this->addToClasses($path);
            }
        }
    }

    public function __construct()
    {
        $this->loadClasses();
    }

    /**
     * @param string $subPath
     * @param string $rootPath
     *
     * @return bool
     */
    private function isSubSourceClass(string $subPath, string $rootPath): bool
    {
        return substr($rootPath, 0, strlen($subPath)) === $subPath;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\SourceClassInformationServiceInterface::getAllSourceClasses()
     */
    public function getAllSourceClasses(): array
    {
        return $this->allClasses;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\SourceClassInformationServiceInterface::getAllSubSourceClasses()
     */
    public function getAllSubSourceClasses(string $subNamespace): array
    {
        $subSourceClasses = [];
        foreach ($this->allClasses as $class) {
            if ($this->isSubSourceClass($subNamespace, $class)) {
                $subSourceClasses[] = $class;
            }
        }

        return $subSourceClasses;
    }
}
