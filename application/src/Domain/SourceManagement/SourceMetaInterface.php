<?php

namespace App\Domain\SourceManagement;

use App\Domain\TemplateManagement\TemplateMetaInterface;
use App\Entity\Source\SourceInterface;
use App\Domain\FormManagement\FormMetaInterface;

/**
 * A meta source offers informations, which the system needs to handle the source.
 *
 * @deprecated
 *
 * @author kevinfrantz
 */
interface SourceMetaInterface
{
    public function getSourceReflection(): \ReflectionClass;

    public function getInterfaceReflection(): \ReflectionClass;

    public function getTemplateMeta(): TemplateMetaInterface;

    /**
     * @return array the namespace elements without the root
     */
    public function getBasicPathArray(): array;

    /**
     * @return string Short class name in lower case without "Abstract" and "Source"
     */
    public function getBasicName(): string;

    /**
     * @return SourceInterface The source to which the meta object belongs to
     */
    public function getSource(): SourceInterface;

    public function getFormMeta(): FormMetaInterface;
}
