<?php

namespace App\Domain\FormManagement;

use App\Domain\TemplateManagement\TemplatePathInformationInterface;

/**
 * @author kevinfrantz
 */
interface FormMetaInformationInterface
{
    /**
     * @return string The string to the form class
     */
    public function getFormClass(): string;

    /**
     * @return TemplatePathInformationInterface The form template path information
     */
    public function getTemplatePathInformation(): TemplatePathInformationInterface;
}
