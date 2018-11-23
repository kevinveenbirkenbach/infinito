<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\SourceManagement\SourceMetaInterface;
use App\Entity\Source\Complex\UserSource;
use App\Domain\SourceManagement\SourceMeta;
use App\Entity\Source\Complex\UserSourceInterface;
use App\Domain\TemplateManagement\TemplateMetaInterface;
use App\Entity\Source\SourceInterface;

class SourceMetaTest extends TestCase
{
    /**
     * @var SourceMetaInterface
     */
    protected $sourceMeta;

    /**
     * @var SourceInterface
     */
    protected $source;

    public function setUp(): void
    {
        $this->source = new UserSource();
        $this->sourceMeta = new SourceMeta($this->source);
    }

    public function testBasicName(): void
    {
        $this->assertEquals('user', $this->sourceMeta->getBasicName());
        $this->assertNotEquals('user2', $this->sourceMeta->getBasicName());
    }

    public function testBasicPath(): void
    {
        $subset = ['entity', 'source', 'complex'];
        $amount = count($subset);
        $basicPathArray = $this->sourceMeta->getBasicPathArray();
        for ($index = 0; $index < $amount; ++$index) {
            $this->assertEquals($subset[$index], $basicPathArray[$index]);
        }
        $this->assertArraySubset($subset, $basicPathArray);
        $this->assertEquals($amount, count($basicPathArray));
    }

    public function testInterfaceReflection(): void
    {
        /**
         * @var \ReflectionClass
         */
        $interfaceReflection = $this->sourceMeta->getInterfaceReflection();
        $this->assertEquals(UserSourceInterface::class, $interfaceReflection->getName());
    }

    public function testSourceReflection(): void
    {
        /**
         * @var \ReflectionClass
         */
        $sourceReflection = $this->sourceMeta->getSourceReflection();
        $this->assertEquals(UserSource::class, $sourceReflection->getName());
    }

    public function testTemplateMeta(): void
    {
        $this->assertInstanceOf(TemplateMetaInterface::class, $this->sourceMeta->getTemplateMeta());
    }

    public function testSource(): void
    {
        $this->assertEquals($this->source, $this->sourceMeta->getSource());
    }
}
