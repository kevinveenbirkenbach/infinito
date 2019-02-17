<?php

namespace Infinito\Domain\FormManagement;

use Infinito\Domain\TemplateManagement\TemplatePathInformationInterface;
use Infinito\Domain\EntityManagement\EntityMetaInformationInterface;

/**
 * @author kevinfrantz
 *
 * @deprecated
 */
final class FormMetaInformation implements FormMetaInformationInterface
{
    const FOLDER = 'form';

    /**
     * @var EntityMetaInformationInterface
     */
    private $entityMetaInformation;

    /**
     * @var string
     */
    private $formClass;

    /**
     * @param EntityMetaInformationInterface $entityMetaInformation
     */
    public function __construct(EntityMetaInformationInterface $entityMetaInformation)
    {
        $this->entityMetaInformation = $entityMetaInformation;
        $this->setFormClass();
    }

    private function setFormClass(): void
    {
        $this->formClass = 'Infinito\\Form';
        foreach ($this->entityMetaInformation->getNamespacePathMap()->getFolders() as $element) {
            $this->formClass .= '\\'.ucfirst($element);
        }
        $this->formClass .= '\\'.ucfirst($this->entityMetaInformation->getPureName()).'Type';
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FormManagement\FormMetaInformationInterface::getFormClass()
     */
    public function getFormClass(): string
    {
        return $this->formClass;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FormManagement\FormMetaInformationInterface::getTemplatePathInformation()
     */
    public function getTemplatePathInformation(): TemplatePathInformationInterface
    {
        return $this->entityMetaInformation->getTemplatePathFormAndView()->getForm();
    }
}
