<?php

namespace Tests\Unit\Domain\TemplateManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Entity\Source\Primitive\Name\FirstNameSource;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\TemplateManagement\TemplatePathInformation;
use Infinito\Domain\SourceManagement\SourceMetaInformation;
use Infinito\DBAL\Types\RESTResponseType;

class TemplatePathInformationTest extends TestCase
{
    /**
     * @var TemplatePathInformation
     */
    private $templateMeta;

    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @param string $type
     * @param string $context
     *
     * @return string
     */
    private function getExpectedPath(string $type, string $context): string
    {
        return $context.'/entity/source/primitive/name/firstname.'.$type.'.twig';
    }

    public function setUp(): void
    {
        $this->source = new FirstNameSource();
        $sourceMeta = new SourceMetaInformation($this->source);
        $folder = $sourceMeta->getNamespacePathMap()->getPath();
        $this->templateMeta = new TemplatePathInformation($sourceMeta->getPureName(), $folder, 'entity');
    }

    public function testFrameTemplatePath(): void
    {
        $this->assertEquals($this->getExpectedPath('html', 'molecule'), $this->templateMeta->getMoleculeTemplatePath());
    }

    public function testContentTemplatePath(): void
    {
        $this->assertEquals($this->getExpectedPath('html', 'atom'), $this->templateMeta->getAtomTemplatePath());
    }

    public function testSetType(): void
    {
        foreach (RESTResponseType::getChoices() as $type) {
            $this->templateMeta->reloadType($type);
            $this->assertEquals($this->getExpectedPath($type, 'atom'), $this->templateMeta->getAtomTemplatePath());
            $this->assertEquals($this->getExpectedPath($type, 'molecule'), $this->templateMeta->getMoleculeTemplatePath());
            $this->assertEquals($type, $this->templateMeta->getCrud());
        }
    }
}
