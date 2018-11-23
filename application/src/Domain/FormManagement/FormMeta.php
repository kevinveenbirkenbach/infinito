<?php

namespace App\Domain\FormManagement;

use App\Domain\SourceManagement\SourceMetaInterface;
use App\Domain\TemplateManagement\TemplateMetaInterface;
use App\Domain\TemplateManagement\TemplateMeta;

/**
 * @author kevinfrantz
 */
class FormMeta implements FormMetaInterface
{
    const FOLDER = 'form';

    /**
     * @var SourceMetaInterface
     */
    private $sourceMeta;

    /**
     * @var TemplateMetaInterface
     */
    private $templateMeta;

    /**
     * @var string
     */
    private $formClass;

    public function __construct(SourceMetaInterface $sourceMeta)
    {
        $this->sourceMeta = $sourceMeta;
        $this->setMeta();
        $this->setFormClass();
    }

    private function setFormClass(): void
    {
        $this->formClass = 'App\\Form\\'.implode('\\', $this->sourceMeta->getBasicPathArray()).'\\'.$this->sourceMeta->getBasicName().'Type';
    }

    private function setMeta(): void
    {
        $this->templateMeta = new TemplateMeta($this->sourceMeta->getBasicPathArray(), $this->sourceMeta->getBasicName(), self::FOLDER);
    }

    public function getFormClass(): string
    {
        return $this->formClass;
    }

    public function getTemplateMeta(): string
    {
        return $this->templateMeta;
    }
}
