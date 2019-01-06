<?php

namespace Tests\Unit\Domain\FormManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Primitive\Name\SurnameSource;
use App\Domain\FormManagement\FormMetaInformationInterface;
use App\Domain\SourceManagement\SourceMetaInformation;
use App\Domain\FormManagement\FormMetaInformation;
use App\Domain\TemplateManagement\TemplatePathInformationInterface;

/**
 * @author kevinfrantz
 */
class FormMetaInformationTest extends TestCase
{
    const FORM_CLASS = 'App\Form\Source\Primitive\Name\SurnameType';

    const FORM_VIEW_ATOM = 'atom/form/source/primitive/name/surname.html.twig';

    const FORM_VIEW_MOLECULE = 'molecule/form/source/primitive/name/surname.html.twig';

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
        $this->assertEquals(self::FORM_CLASS, $this->formMeta->getFormClass());
    }

    public function testGetView(): void
    {
        $this->assertEquals(self::FORM_VIEW_ATOM, $this->formMeta->getTemplatePathInformation()->getAtomTemplatePath());
        $this->assertEquals(self::FORM_VIEW_MOLECULE, $this->formMeta->getTemplatePathInformation()->getMoleculeTemplatePath());
    }

    public function testTemplateMeta(): void
    {
        $templatePathInformation = $this->formMeta->getTemplatePathInformation();
        $this->assertInstanceOf(TemplatePathInformationInterface::class, $templatePathInformation);
        $this->assertEquals('atom/form/source/primitive/name/surname.html.twig', $templatePathInformation->getAtomTemplatePath());
    }
}
