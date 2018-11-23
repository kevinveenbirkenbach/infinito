<?php

namespace App\Domain\FormManagement;

use App\Domain\SourceManagement\SourceMetaInterface;

class FormMeta implements FormMetaInterface
{
    public function __construct(SourceMetaInterface $source)
    {
    }

    public function getFormPath(): string
    {
    }
}
