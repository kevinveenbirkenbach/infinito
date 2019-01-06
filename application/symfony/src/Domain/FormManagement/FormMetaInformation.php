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
     * @var TemplatePathInformationInterface
     */
    private $templatePathInformation;

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
        $this->setTemplateMetaInformation();
        $this->setFormClass();
    }

    private function setFormClass(): void
    {
        $this->formClass = 'App\\Form';
        foreach ($this->entityMetaInformation->getBasicPathArray() as $element) {
            $this->formClass .= '\\'.ucfirst($element);
        }
        $this->formClass .= '\\'.ucfirst($this->entityMetaInformation->getPureName()).'Type';
    }

    private function setTemplateMetaInformation(): void
    {
        $this->templatePathInformation = $this->entityMetaInformation->getTemplatePathFormAndView()->getForm();
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
        return $this->templatePathInformation;
    }
}
