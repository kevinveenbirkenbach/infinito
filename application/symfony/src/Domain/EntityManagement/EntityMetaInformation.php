<?php

namespace App\Domain\EntityManagement;

use App\Domain\TemplateManagement\TemplatePathFormAndViewInterface;
use App\Entity\EntityInterface;
use src\Domain\TemplateManagement\TemplatePathFormAndView;
use App\Domain\FormManagement\FormMetaInformationInterface;
use App\Domain\FormManagement\FormMetaInformation;

/**
 * @author kevinfrantz
 */
class EntityMetaInformation implements EntityMetaInformationInterface
{
    /**
     * @var \ReflectionClass
     */
    private $entityReflection;

    /**
     * @var \ReflectionClass
     */
    private $interfaceReflection;

    /**
     * @var TemplatePathFormAndViewInterface
     */
    private $templatePathFormAndView;

    /**
     * @var array
     */
    private $basicPathArray;

    /**
     * @var string
     */
    private $pureName;

    /**
     * @var EntityInterface
     */
    private $entity;

    /**
     * @var FormMetaInformationInterface
     */
    private $formMetaInformation;

    /**
     * @param EntityInterface $entity
     */
    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
        $this->entityReflection = new \ReflectionClass($entity);
        $this->setBasicPathArray();
        $this->setPureName();
        $this->setInterfaceReflection();
        $this->setTemplatePathFormAndView();
        $this->formMetaInformation = new FormMetaInformation($this);
    }

    private function setTemplatePathFormAndView(): void
    {
        $this->templatePathFormAndView = new TemplatePathFormAndView(implode('/', $this->basicPathArray), $this->pureName);
    }

    private function setBasicPathArray(): void
    {
        $namespace = $this->entityReflection->getNamespaceName();
        $namespaceWithoutRoot = str_replace('App\\Entity\\', '', $namespace);
        $this->basicPathArray = [];
        foreach (explode('\\', $namespaceWithoutRoot) as $element) {
            $this->basicPathArray[] = strtolower($element);
        }
    }

    private function setInterfaceReflection(): void
    {
        $namespace = str_replace('\Abstract', '\\', $this->entityReflection->getName()).'Interface';
        $this->interfaceReflection = new \ReflectionClass($namespace);
    }

    protected function setPureName(): void
    {
        $withoutAbstract = str_replace('Abstract', '', $this->entityReflection->getShortName());
        $this->pureName = strtolower($withoutAbstract);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformationInterface::getBasicPathArray()
     */
    public function getBasicPathArray(): array
    {
        return $this->basicPathArray;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformationInterface::getInterfaceReflection()
     */
    public function getInterfaceReflection(): \ReflectionClass
    {
        return $this->interfaceReflection;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformationInterface::getPureName()
     */
    public function getPureName(): string
    {
        return $this->pureName;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformationInterface::getTemplatePathFormAndView()
     */
    public function getTemplatePathFormAndView(): TemplatePathFormAndViewInterface
    {
        return $this->templatePathFormAndView;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformationInterface::getEntity()
     */
    public function getEntity(): EntityInterface
    {
        return $this->entity;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformationInterface::getEntityReflection()
     */
    public function getEntityReflection(): \ReflectionClass
    {
        return $this->entityReflection;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformationInterface::getFormMetaInformation()
     */
    public function getFormMetaInformation(): FormMetaInformationInterface
    {
        return $this->formMetaInformation;
    }
}
