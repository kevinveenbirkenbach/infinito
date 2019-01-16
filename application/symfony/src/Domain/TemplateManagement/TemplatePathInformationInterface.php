<?php

namespace App\Domain\TemplateManagement;

use App\DBAL\Types\RESTResponseType;

/**
 * Manages all informations which are needed to process templates.
 *
 * @author kevinfrantz
 */
interface TemplatePathInformationInterface extends ReloadTypeInterface
{
    /**
     * @return string A template inclusiv frame. (Standalone)
     */
    public function getMoleculeTemplatePath(): string;

    /**
     * @return string a template without a frame
     */
    public function getAtomTemplatePath(): string;

    /**
     * @see RESTResponseType::$choices
     *
     * @return string Type of the template
     */
    public function getCrud(): string;
}
