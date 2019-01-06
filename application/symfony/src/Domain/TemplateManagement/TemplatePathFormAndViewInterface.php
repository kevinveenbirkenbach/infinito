<?php

namespace App\Domain\TemplateManagement;

/**
 * @author kevinfrantz
 */
interface TemplatePathFormAndViewInterface extends ReloadTypeInterface
{
    /**
     * @return TemplatePathInformationInterface
     */
    public function getForm(): TemplatePathInformationInterface;

    /**
     * @return TemplatePathInformationInterface
     */
    public function getView(): TemplatePathInformation;
}
