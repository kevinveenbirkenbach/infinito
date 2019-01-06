<?php

namespace Tests\Unit\Domain\FormManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Primitive\Name\SurnameSource;
use App\Domain\FormManagement\FormMetaInformationInterface;
use App\Domain\SourceManagement\SourceMetaInformation;
use App\Domain\FormManagement\FormMetaInformation;
use App\Domain\TemplateManagement\TemplatePathInformationInterface;

class FormMetaInformationTest extends TestCase
{
    /**
     * @var FormMetaInformationInterface
     */
    private $formMeta;

    public function setUp(): void
    {
        $sourceMeta = new SourceMetaInformation(new SurnameSource());
        $this->formMeta = new FormMetaInformation($sourceMeta);
    }

    public function testGetFormClass(): void
    {
        $this->assertEquals('App\Form\Source\Primitive\Name\SurnameType', $this->formMeta->getFormClass());
    }

    public function testTemplateMeta(): void
    {
        $templatePathInformation = $this->formMeta->getTemplatePathInformation();
        $this->assertInstanceOf(TemplatePathInformationInterface::class, $templatePathInformation);
        $this->assertEquals('atom/form/source/primitive/name/surname.html.twig', $templatePathInformation->getAtomTemplatePath());
    }
}
