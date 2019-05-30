<?php

namespace tests\Unit\Domain\Path;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Path\NamespacePathMapInterface;
use Infinito\Domain\Path\NamespacePathMap;

/**
 * @author kevinfrantz
 */
class NamespacePathMapTest extends TestCase
{
    const NAMESPACE = 'ABC\\DEF\GHD';

    const PATH = 'abc/def/ghd';

    const FOLDERS = [
        'ABC',
        'DEF',
        'GHD',
    ];

    /**
     * @var NamespacePathMapInterface
     */
    private $namespacePathMap;

    public function setUp(): void
    {
        $this->namespacePathMap = new NamespacePathMap();
    }

    private function validateArray(): void
    {
        $folders = $this->namespacePathMap->getFolders();
        foreach (self::FOLDERS as $key => $folder) {
            $this->assertEquals(strtolower($folder), $folders[$key]);
        }
    }

    private function validateGet(): void
    {
        $this->assertEquals(strtolower(self::NAMESPACE), $this->namespacePathMap->getNamespace());
        $this->assertEquals(self::PATH, $this->namespacePathMap->getPath());
        $this->validateArray();
    }

    public function testSetNamespace(): void
    {
        $this->namespacePathMap->setNamespace(self::NAMESPACE);
        $this->validateGet();
    }

    public function testSetPath(): void
    {
        $this->namespacePathMap->setPath(self::PATH);
        $this->validateGet();
    }

    public function testSetFolders(): void
    {
        $this->namespacePathMap->setFolders(self::FOLDERS);
        $this->validateGet();
    }
}
