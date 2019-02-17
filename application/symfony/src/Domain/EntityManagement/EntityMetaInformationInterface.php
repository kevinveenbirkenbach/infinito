<?php

namespace Infinito\Domain\EntityManagement;

use Infinito\Entity\EntityInterface;
use Infinito\Domain\TemplateManagement\TemplatePathFormAndViewInterface;
use Infinito\Domain\FormManagement\FormMetaInformationInterface;
use Infinito\Domain\PathManagement\NamespacePathMap;
use Infinito\Domain\PathManagement\NamespacePathMapInterface;

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
