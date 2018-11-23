<?php

namespace App\Domain\TemplateManagement;

use App\Domain\FormManagement\FormMetaInterface;

/**
 * Manages all informations which are needed to process templates.
 *
 * @author kevinfrantz
 */
interface TemplateMetaInterface
{
    /**
     * Sets the template type which should be processed(General html);.
     */
    public function setTemplateType(string $type): void;

    /**
     * Returns a template inclusiv frame.
     *
     * @return string
     */
    public function getFramedTemplatePath(): string;

    /**
     * Returns a template without a frame.
     *
     * @return string
     */
    public function getFramelessTemplatePath(): string;

    /**
     * @return FormMetaInterface
     */
    public function getFormMeta(): FormMetaInterface;
}
