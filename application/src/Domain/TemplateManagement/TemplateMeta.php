<?php

namespace App\Domain\TemplateManagement;

use App\Domain\SourceManagement\SourceMetaInterface;
use App\DBAL\Types\TemplateType;

/**
 * @author kevinfrantz
 */
class TemplateMeta implements TemplateMetaInterface
{
    /**
     * @var SourceMetaInterface
     */
    private $sourceMeta;

    /**
     * @var string
     */
    private $type = TemplateType::HTML;

    /**
     * @var string
     */
    private $pathSuffix;

    /**
     * @var string
     */
    private $frameTemplatePath;

    /**
     * @var string
     */
    private $contentTemplatePath;

    public function __construct(SourceMetaInterface $sourceMeta)
    {
        $this->sourceMeta = $sourceMeta;
        $this->init();
    }

    private function init()
    {
        $this->setPathSuffix();
        $this->setFrameTemplatePath();
        $this->setContentTemplatePath();
    }

    private function setPathSuffix(): void
    {
        $this->pathSuffix = implode('/', $this->sourceMeta->getBasicPathArray()).'/'.$this->sourceMeta->getBasicName().'.'.$this->type.'.twig';
    }

    private function setFrameTemplatePath(): void
    {
        $this->frameTemplatePath = 'frame/'.$this->pathSuffix;
    }

    private function setContentTemplatePath(): void
    {
        $this->contentTemplatePath = 'content/'.$this->pathSuffix;
    }

    public function getFrameTemplatePath(): string
    {
        return $this->frameTemplatePath;
    }

    public function getContentTemplatePath(): string
    {
        return $this->contentTemplatePath;
    }

    public function setTemplateType(string $type): void
    {
        $this->type = $type;
        $this->init();
    }

    public function getTemplateType(): string
    {
        return $this->type;
    }
}
