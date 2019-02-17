<?php

namespace Infinito\Domain\EntityManagement;

use Infinito\Domain\TemplateManagement\TemplatePathFormAndViewInterface;
use Infinito\Entity\EntityInterface;
use Infinito\Domain\TemplateManagement\TemplatePathFormAndView;
use Infinito\Domain\FormManagement\FormMetaInformationInterface;
use Infinito\Domain\FormManagement\FormMetaInformation;
use Infinito\Domain\PathManagement\NamespacePathMapInterface;
use Infinito\Domain\PathManagement\NamespacePathMap;

/**
 * @author kevinfrantz
 *
 * @deprecated
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
     * @var string
     */
    protected $pureName;

    /**
     * @var EntityInterface
     */
    private $entity;

    /**
     * @var FormMetaInformationInterface
     */
    private $formMetaInformation;

    /**
     * @var NamespacePathMapInterface
     */
    private $namespacePathMap;

    /**
     * @param EntityInterface $entity
     */
    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
        $this->entityReflection = new \ReflectionClass($entity);
        $this->setNamespacePathMap();
        $this->setPureName();
        $this->setInterfaceReflection();
        $this->setTemplatePathFormAndView();
        $this->formMetaInformation = new FormMetaInformation($this);
    }

    private function setTemplatePathFormAndView(): void
    {
        $this->templatePathFormAndView = new TemplatePathFormAndView($this->pureName, $this->namespacePathMap->getPath());
    }

    private function setNamespacePathMap(): void
    {
        $namespace = $this->entityReflection->getNamespaceName();
        $namespaceWithoutRoot = str_replace('Infinito\\Entity\\', '', $namespace);
        $this->namespacePathMap = new NamespacePathMap();
        $this->namespacePathMap->setNamespace($namespaceWithoutRoot);
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
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformationInterface::getInterfaceReflection()
     */
    public function getInterfaceReflection(): \ReflectionClass
    {
        return $this->interfaceReflection;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformationInterface::getPureName()
     */
    public function getPureName(): string
    {
        return $this->pureName;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformationInterface::getTemplatePathFormAndView()
     */
    public function getTemplatePathFormAndView(): TemplatePathFormAndViewInterface
    {
        return $this->templatePathFormAndView;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformationInterface::getEntity()
     */
    public function getEntity(): EntityInterface
    {
        return $this->entity;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformationInterface::getEntityReflection()
     */
    public function getEntityReflection(): \ReflectionClass
    {
        return $this->entityReflection;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformationInterface::getFormMetaInformation()
     */
    public function getFormMetaInformation(): FormMetaInformationInterface
    {
        return $this->formMetaInformation;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformationInterface::getNamespacePathMap()
     */
    public function getNamespacePathMap(): NamespacePathMapInterface
    {
        return $this->namespacePathMap;
    }
}
