<?php

namespace App\Domain\TemplateManagement;

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
}
