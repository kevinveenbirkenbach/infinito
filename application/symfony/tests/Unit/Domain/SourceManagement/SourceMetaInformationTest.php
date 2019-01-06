<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Complex\UserSource;
use App\Entity\Source\Complex\UserSourceInterface;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\SourceMetaInformation;
use App\Domain\SourceManagement\SourceMetaInformationInterface;
use App\Domain\TemplateManagement\TemplatePathFormAndViewInterface;
use App\Domain\FormManagement\FormMetaInformationInterface;
use App\Entity\EntityInterface;
use App\Exception\NotCorrectInstanceException;

class SourceMetaInformationTest extends TestCase
{
    const FOLDERS = [
        'source',
        'complex',
    ];

    /**
     * @var SourceMetaInformationInterface
     */
    private $sourceMetaInformation;

    /**
     * @var SourceInterface
     */
    private $source;

    public function setUp(): void
    {
        $this->source = new UserSource();
        $this->sourceMetaInformation = new SourceMetaInformation($this->source);
    }

    public function testBasicName(): void
    {
        $this->assertEquals('user', $this->sourceMetaInformation->getPureName());
        $this->assertNotEquals('user2', $this->sourceMetaInformation->getPureName());
    }

    public function testFolders(): void
    {
        $amount = count(self::FOLDERS);
        $folders = $this->sourceMetaInformation->getNamespacePathMap()->getFolders();
        for ($index = 0; $index < $amount; ++$index) {
            $this->assertEquals(self::FOLDERS[$index], $folders[$index]);
        }
        $this->assertArraySubset(self::FOLDERS, $folders);
        $this->assertEquals($amount, count($folders));
    }

    public function testInterfaceReflection(): void
    {
        /**
         * @var \ReflectionClass
         */
        $interfaceReflection = $this->sourceMetaInformation->getInterfaceReflection();
        $this->assertEquals(UserSourceInterface::class, $interfaceReflection->getName());
    }

    public function testSourceReflection(): void
    {
        /**
         * @var \ReflectionClass
         */
        $sourceReflection = $this->sourceMetaInformation->getEntityReflection();
        $this->assertEquals(UserSource::class, $sourceReflection->getName());
    }

    public function testTemplateMeta(): void
    {
        $this->assertInstanceOf(TemplatePathFormAndViewInterface::class, $this->sourceMetaInformation->getTemplatePathFormAndView());
    }

    public function testSource(): void
    {
        $this->assertEquals($this->source, $this->sourceMetaInformation->getEntity());
    }

    public function testFormMeta(): void
    {
        $this->assertInstanceOf(FormMetaInformationInterface::class, $this->sourceMetaInformation->getFormMetaInformation());
    }

    public function testTypeError(): void
    {
        $this->expectException(NotCorrectInstanceException::class);
        new SourceMetaInformation($this->createMock(EntityInterface::class));
    }
}
