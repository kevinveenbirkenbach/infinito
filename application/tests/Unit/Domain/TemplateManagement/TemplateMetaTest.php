<?php

namespace Tests\Unit\Domain\TemplateManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\TemplateManagement\TemplateMetaInterface;
use App\Entity\Source\Primitive\Name\FirstNameSource;
use App\Entity\Source\SourceInterface;
use App\Domain\TemplateManagement\TemplateMeta;
use App\Domain\SourceManagement\SourceMeta;

class TemplateMetaTest extends TestCase
{
    /**
     * @var TemplateMetaInterface
     */
    protected $templateMeta;

    /**
     * @var SourceInterface
     */
    protected $source;

    private function getExpectedPath(string $type, string $context): string
    {
        return $context.'/source/primitive/name/firstname.'.$type.'.twig';
    }

    public function setUp(): void
    {
        $this->source = new FirstNameSource();
        $this->templateMeta = new TemplateMeta(new SourceMeta($this->source));
    }

    public function testFrameTemplatePath(): void
    {
        $this->assertEquals($this->getExpectedPath('html', 'frame'), $this->templateMeta->getFrameTemplatePath());
    }

    public function testContentTemplatePath(): void
    {
        $this->assertEquals($this->getExpectedPath('html', 'content'), $this->templateMeta->getContentTemplatePath());
    }

    public function testSetType(): void
    {
        $this->templateMeta->setTemplateType('json');
        $this->assertEquals($this->getExpectedPath('json', 'content'), $this->templateMeta->getContentTemplatePath());
        $this->assertEquals($this->getExpectedPath('json', 'frame'), $this->templateMeta->getFrameTemplatePath());
        $this->assertEquals('json', $this->templateMeta->getTemplateType());
    }
}
