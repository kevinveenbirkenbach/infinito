<?php

namespace Infinito\Domain\TemplateManagement;

use Infinito\DBAL\Types\RESTResponseType;

/**
 * Manages all informations which are needed to process templates.
 *
 * @author kevinfrantz
 *
 * @deprecated
 * @see TemplatePathServiceInterface
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
     * @todo Check if this is really needed. Otherwise remove it!
     *
     * @see RESTResponseType::$choices
     *
     * @return string Type of the template
     */
    public function getCrud(): string;
}
