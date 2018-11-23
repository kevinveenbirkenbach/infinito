<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\FormManagement\FormMetaInterface;
use App\Domain\FormManagement\FormMeta;
use App\Entity\Source\Primitive\Name\SurnameSource;
use App\Domain\SourceManagement\SourceMeta;
use App\Domain\TemplateManagement\TemplateMetaInterface;

class FormMetaTest extends TestCase
{
    /**
     * @var FormMetaInterface
     */
    protected $formMeta;

    public function setUp(): void
    {
        $sourceMeta = new SourceMeta(new SurnameSource());
        $this->formMeta = new FormMeta($sourceMeta);
    }

    public function testGetFormClass(): void
    {
        $this->assertEquals('App\Form\Source\Primitive\Name\SurnameType', $this->formMeta->getFormClass());
    }

    public function testTemplateMeta(): void
    {
        $this->assertInstanceOf(TemplateMetaInterface::class, $this->formMeta->getTemplateMeta());
    }
}
