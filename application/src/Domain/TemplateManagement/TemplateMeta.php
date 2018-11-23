<?php

namespace App\Domain\TemplateManagement;

use App\Domain\FormManagement\FormMetaInterface;
use App\Domain\SourceManagement\SourceMetaInterface;
use App\DBAL\Types\TemplateType;

class TemplateMeta implements TemplateMetaInterface
{
    /**
     * @var TemplateMetaInterface
     */
    private $sourceMeta;

    /**
     * @var string
     */
    private $type = TemplateType::HTML;

    public function __construct(SourceMetaInterface $sourceMeta)
    {
        $this->sourceMeta = $sourceMeta;
    }

    public function getFramedTemplatePath(): string
    {
    }

    public function getFramelessTemplatePath(): string
    {
    }

    public function getFormMeta(): FormMetaInterface
    {
    }

    public function setTemplateType(string $type): void
    {
    }
}
