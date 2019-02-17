<?php

namespace Infinito\Domain\TemplateManagement;

/**
 * @author kevinfrantz
 */
interface TemplateNameServiceInterface
{
    /**
     * @return string A template inclusiv frame. (Standalone)
     */
    public function getMoleculeTemplateName(): string;

    /**
     * @return string a template without a frame
     */
    public function getAtomTemplateName(): string;
}
