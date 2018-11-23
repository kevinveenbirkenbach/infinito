<?php

namespace App\Domain\SourceManagement;

use App\Domain\TemplateManagement\TemplateMetaInterface;
use App\Entity\Source\SourceInterface;
use App\Domain\TemplateManagement\TemplateMeta;

/**
 * @author kevinfrantz
 */
class SourceMeta implements SourceMetaInterface
{
    /**
     * @var \ReflectionClass
     */
    private $sourceReflection;

    /**
     * @var \ReflectionClass
     */
    private $interfaceReflection;

    /**
     * @var TemplateMetaInterface
     */
    private $templateMeta;

    /**
     * @var array
     */
    private $basicPathArray;

    /**
     * @var string
     */
    private $basicName;

    /**
     * @var SourceInterface
     */
    private $source;

    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
        $this->sourceReflection = new \ReflectionClass($source);
        $this->setBasicPathArray();
        $this->setBasicName();
        $this->setInterfaceReflection();
        $this->templateMeta = new TemplateMeta($this);
    }

    private function setBasicPathArray(): void
    {
        $namespace = $this->sourceReflection->getNamespaceName();
        $namespaceWithoutRoot = str_replace('App\\Entity\\', '', $namespace);
        $this->basicPathArray = [];
        foreach (explode('\\', $namespaceWithoutRoot) as $element) {
            $this->basicPathArray[] = strtolower($element);
        }
    }

    private function setInterfaceReflection(): void
    {
        $namespace = str_replace('\Abstract', '\\', $this->sourceReflection->getName()).'Interface';
        $this->interfaceReflection = new \ReflectionClass($namespace);
    }

    private function setBasicName(): void
    {
        $withoutAbstract = str_replace('Abstract', '', $this->sourceReflection->getShortName());
        $withoutSource = str_replace('Source', '', $withoutAbstract);
        $this->basicName = strtolower($withoutSource);
    }

    public function getBasicPathArray(): array
    {
        return $this->basicPathArray;
    }

    public function getInterfaceReflection(): \ReflectionClass
    {
        return $this->interfaceReflection;
    }

    public function getSourceReflection(): \ReflectionClass
    {
        return $this->sourceReflection;
    }

    public function getTemplateMeta(): TemplateMetaInterface
    {
        return $this->templateMeta;
    }

    public function getBasicName(): string
    {
        return $this->basicName;
    }

    public function getSource(): SourceInterface
    {
        return $this->source;
    }
}
