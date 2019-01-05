<?php

namespace App\Domain\TemplateManagement;

use App\DBAL\Types\RESTResponseType;

/**
 * @author kevinfrantz
 */
final class TemplateMeta implements TemplateMetaInterface
{
    /**
     * @var array
     */
    private $basicPathArray;

    /**
     * @var string
     */
    private $basicName;

    /**
     * @var string
     */
    private $type = RESTResponseType::HTML;

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

    /**
     * @var string
     */
    private $folder;

    public function __construct(array $basicPathArray, string $basicName, string $folder)
    {
        $this->basicPathArray = $basicPathArray;
        $this->basicName = $basicName;
        $this->folder = $folder;
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
        $this->pathSuffix = $this->folder.'/'.implode('/', $this->basicPathArray).'/'.$this->basicName.'.'.$this->type.'.twig';
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
