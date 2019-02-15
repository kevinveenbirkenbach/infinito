<?php

namespace App\Domain\EntityManagement;

use App\Entity\EntityInterface;
use App\Domain\TemplateManagement\TemplatePathFormAndViewInterface;
use App\Domain\FormManagement\FormMetaInformationInterface;
use App\Domain\PathManagement\NamespacePathMap;
use App\Domain\PathManagement\NamespacePathMapInterface;

/**
 * Offers some meta information about an entity.
 *
 * @deprecated
 *
 * @author kevinfrantz
 */
interface EntityMetaInformationInterface
{
    /**
     * @return \ReflectionClass
     */
    public function getEntityReflection(): \ReflectionClass;

    /**
     * @return \ReflectionClass
     */
    public function getInterfaceReflection(): \ReflectionClass;

    /**
     * @return TemplatePathFormAndViewInterface Informations about the template path
     */
    public function getTemplatePathFormAndView(): TemplatePathFormAndViewInterface;

    /**
     * @return string Short class name in lower case without "Abstract"
     */
    public function getPureName(): string;

    /**
     * @return EntityInterface Entity to which the meta object belongs to
     */
    public function getEntity(): EntityInterface;

    /**
     * @return FormMetaInformationInterface The meta informations about the form
     */
    public function getFormMetaInformation(): FormMetaInformationInterface;

    /**
     * @return NamespacePathMap
     */
    public function getNamespacePathMap(): NamespacePathMapInterface;
}
