<?php

namespace App\Domain\FormManagement;

interface FormMetaInterface
{
    public function getFormClass(): string;

    public function getTemplateMeta(): string;
}
