<?php

namespace App\Domain\TemplateManagement;

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

    public function getTemplateType(): string;

    /**
     * Returns a template inclusiv frame.
     *
     * @return string
     */
    public function getFrameTemplatePath(): string;

    /**
     * Returns a template without a frame.
     *
     * @return string
     */
    public function getContentTemplatePath(): string;
}
