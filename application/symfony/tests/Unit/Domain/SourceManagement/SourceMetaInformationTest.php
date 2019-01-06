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

class SourceMetaInformationTest extends TestCase
{
    /**
     * @var SourceMetaInformationInterface
     */
    protected $sourceMetaInformation;

    /**
     * @var SourceInterface
     */
    protected $source;

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

    public function testBasicPath(): void
    {
        $subset = ['source', 'complex'];
        $amount = count($subset);
        $basicPathArray = $this->sourceMetaInformation->getBasicPathArray();
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
}
