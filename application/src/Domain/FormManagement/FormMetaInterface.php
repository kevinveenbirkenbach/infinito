<?php

namespace App\Domain\FormManagement;

use App\Domain\TemplateManagement\TemplateMetaInterface;

interface FormMetaInterface
{
    public function getFormClass(): string;

    public function getTemplateMeta(): TemplateMetaInterface;
}
