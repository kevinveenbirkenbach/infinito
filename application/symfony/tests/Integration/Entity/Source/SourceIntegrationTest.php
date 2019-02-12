<?php

namespace Tests\Integration\Entity\Source;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class tests if all needed Depencies for a source are implemented!
 *
 * @author kevinfrantz
 */
class SourceIntegrationTest extends TestCase
{
    /**
     * @var string
     */
    const SOURCE_DIRECTORY = __DIR__.'/../../src/Entity/Source';

    /**
     * @var ArrayCollection
     */
    protected $sources;

    /**
     * @param string $path
     */
    private function iterate(string $path): void
    {
        $directoryIterator = new \DirectoryIterator($path);
        foreach ($directoryIterator as $fileInfo) {
            if (!in_array($fileInfo->getFilename(), [
                '.',
                '..',
                'README.md',
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

    /**
     * @param string $path
     *
     * @return string
     */
    private function filterSourcePath(string $path): string
    {
        $path = str_replace('/Abstract', '/', $path);
        $path = str_replace('.php', '', $path);

        return $path;
    }

    /**
     * @param string $path
     *
     * @return string
     */
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
