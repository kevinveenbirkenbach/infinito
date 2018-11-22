<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class tests if all needed Depencies for a source are implemented!
 *
 * @author kevinfrantz
 */
class SourceIntegrationTest extends TestCase
{
    const SOURCE_DIRECTORY = __DIR__.'/../../src/Entity/Source';

    /**
     * @var ArrayCollection
     */
    protected $sources;

    private function iterate(string $path)
    {
        $directoryIterator = new \DirectoryIterator($path);
        foreach ($directoryIterator as $fileInfo) {
            if (!in_array($fileInfo->getFilename(), [
                '.',
                '..',
            ])) {
                $pathname = $fileInfo->getPathname();
                if ($fileInfo->isDir()) {
                    $this->iterate($pathname);
                } elseif (false === strpos($pathname, 'Interface.php')) {
                    $this->sources->add(realpath($pathname));
                }
            }
        }
    }

    public function setUp(): void
    {
        $this->sources = new ArrayCollection();
        $this->iterate(self::SOURCE_DIRECTORY);
    }

    private function filterSourcePath(string $path): string
    {
        $path = str_replace('/Abstract', '/', $path);
        $path = str_replace('.php', '', $path);

        return $path;
    }

    private function getInterfacePath(string $path): string
    {
        return $this->filterSourcePath($path).'Interface.php';
    }

    public function testInterfaces(): void
    {
        foreach ($this->sources as $source) {
            $interfacePath = $this->getInterfacePath($source);
            $this->assertTrue(file_exists($this->getInterfacePath($source)), "Interface $interfacePath for $source doesn't exist!");
        }
    }
}
