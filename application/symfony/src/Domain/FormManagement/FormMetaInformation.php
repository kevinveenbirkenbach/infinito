<?php

namespace App\Domain\FormManagement;

use App\Domain\TemplateManagement\TemplatePathInformationInterface;
use App\Domain\EntityManagement\EntityMetaInformationInterface;

/**
 * @author kevinfrantz
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
        $this->formClass = 'App\\Form';
        foreach ($this->entityMetaInformation->getNamespacePathMap()->getFolders() as $element) {
            $this->formClass .= '\\'.ucfirst($element);
        }
        $this->formClass .= '\\'.ucfirst($this->entityMetaInformation->getPureName()).'Type';
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\FormManagement\FormMetaInformationInterface::getFormClass()
     */
    public function getFormClass(): string
    {
        return $this->formClass;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\FormManagement\FormMetaInformationInterface::getTemplatePathInformation()
     */
    public function getTemplatePathInformation(): TemplatePathInformationInterface
    {
        return $this->entityMetaInformation->getTemplatePathFormAndView()->getForm();
    }
}
