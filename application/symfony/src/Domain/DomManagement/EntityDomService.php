<?php

namespace Infinito\Domain\DomManagement;

use Infinito\Entity\EntityInterface;
use Infinito\Domain\LayerManagement\LayerClassMap;
use Infinito\Domain\RightManagement\RightTransformerService;
use Doctrine\Common\Collections\Collection;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityServiceInterface;
use Infinito\Exception\NotCorrectInstanceException;
use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * This class is not ready and not tested!
 *
 * @todo Implement tests!
 * @todo finish class!
 * @todo refactor class!
 *
 * @author kevinfrantz
 */
final class EntityDomService implements EntityDomServiceInterface
{
    /**
     * @var string
     */
    const GET_METHOD = RightTransformerService::GET_PREFIX;

    /**
     * @var string
     */
    const HAS_METHOD = RightTransformerService::HAS_PREFIX;

    /**
     * @var RequestedEntityServiceInterface
     */
    private $requestedEntity;

    /**
     * @var EntityInterface
     */
    private $entity;

    /**
     * @var \ReflectionClass
     */
    private $entityReflectionClass;

    /**
     * @var array[]|\ReflectionProperty[]
     */
    private $properties = [];

    /**
     * @var \DOMDocument
     */
    private $domDocument;

    /**
     * @param RequestedEntityServiceInterface $requestedEntity
     */
    public function __construct(RequestedEntityServiceInterface $requestedEntity)
    {
        $this->requestedEntity = $requestedEntity;
    }

    private function createProperties(): void
    {
        $this->properties = $this->entityReflectionClass->getProperties();
    }

    private function createDomDocument(): void
    {
        $this->domDocument = new \DOMDocument();
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    private function methodExist(string $method): bool
    {
        return $this->entityReflectionClass->hasMethod($method);
    }

    /**
     * @param string $method
     *
     * @return mixed
     */
    private function getMethodResult(string $method)
    {
        return $this->entity->{$method}();
    }

    /**
     * @param string $propertyName
     *
     * @return mixed
     */
    private function getPropertyValue(string $propertyName)
    {
        $hasMethod = $this->getMethodName(self::HAS_METHOD, $propertyName);
        if ($this->methodExist($hasMethod) && !$this->getMethodResult($hasMethod)) {
            return null;
        }
        $getMethod = $this->getMethodName(self::GET_METHOD, $propertyName);
        $result = $this->getMethodResult($getMethod);

        return $result;
    }

    /**
     * @param mixed       $value
     * @param \DOMElement $domElement
     */
    private function mappValue($value, \DOMElement $domElement): void
    {
        foreach (LayerClassMap::LAYER_CLASS_MAP as $layer => $class) {
            if ($value instanceof $class) {
                $domElement->setAttribute('layer', $layer);
                $domElement->setAttribute('id', $value->getId());
                $domElement->setAttribute('name', LayerType::getReadableValue($layer));

                return;
            }
        }
        if (is_object($value)) {
            throw new NotCorrectInstanceException('The instance '.get_class($value).' is not supported!');
        }
        $domElement->setAttribute('value', $value);

        return;
    }

    /**
     * @param string $method
     * @param string $propertyName
     *
     * @return string
     */
    private function getMethodName(string $method, string $propertyName): string
    {
        return $method.ucfirst($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    private function isPropertyAccessible(string $propertyName): bool
    {
        $getMethod = $this->getMethodName(self::GET_METHOD, $propertyName);

        return $this->entityReflectionClass->hasMethod($getMethod);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\DomManagement\EntityDomServiceInterface::getDomDocument()
     */
    public function getDomDocument(): \DOMDocument
    {
        $this->entity = $this->requestedEntity->getEntity();
        $this->entityReflectionClass = new \ReflectionClass($this->entity);
        $this->createProperties();
        $this->createDomDocument();
        foreach ($this->properties as $property) {
            $propertyName = $property->getName();
            if ($this->isPropertyAccessible($propertyName)) {
                $domElement = $this->domDocument->createElement('attribut');
                $domElement->setAttribute('name', $propertyName);
                $value = $this->getPropertyValue($propertyName);
                if ($value instanceof Collection) {
                    foreach ($value as $valueElement) {
                        $domSubElement = $domElement->createElement('list-element');
                        $domElement->setAttribute('name', $propertyName);
                        $this->mappValue($valueElement, $domSubElement);
                        $domElement->appendChild($domSubElement);
                    }
                } else {
                    $this->mappValue($value, $domElement);
                }
                $this->domDocument->appendChild($domElement);
            }
        }
        $this->domDocument->saveXML();

        return $this->domDocument;
    }
}
